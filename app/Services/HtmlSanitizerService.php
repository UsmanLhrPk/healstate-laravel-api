<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlSanitizerService
{
    private HTMLPurifier $purifier;

    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();

        // Allowed tags — covers standard rich-text editor output
        $config->set('HTML.Allowed',
            'p,br,strong,b,em,i,u,s,' .
            'h2,h3,h4,h5,h6,' .
            'ul,ol,li,' .
            'a[href|target|rel],blockquote,code,pre,hr,' .
            'table,thead,tbody,tr,th,td,' .
            'img[src|alt|width|height],' .
            'span,div'
        );

        // Block javascript: and data: URIs in href/src
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'mailto' => true]);

        // Force rel="noopener noreferrer" on target="_blank" links
        $config->set('HTML.TargetBlank', true);
        $config->set('HTML.TargetNoreferrer', true);
        $config->set('HTML.TargetNoopener', true);

        // Cache directory
        $config->set('Cache.SerializerPath', storage_path('app/htmlpurifier'));

        $this->purifier = new HTMLPurifier($config);
    }

    /**
     * Sanitize rich-text HTML (course description, lesson text_content,
     * offering description). Allows a safe subset of tags, strips everything
     * else including all event handlers and javascript: URIs.
     */
    public function sanitize(?string $dirty): ?string
    {
        if ($dirty === null) {
            return null;
        }

        return $this->purifier->purify($dirty);
    }

    /**
     * Sanitize plain-text fields (title, bio, name, phone, notes, reasons).
     * These fields must contain ZERO HTML — strip every tag entirely,
     * then trim whitespace.
     *
     * Use this for any field that is NOT a rich-text editor output.
     */
    public function sanitizePlainText(?string $dirty): ?string
    {
        if ($dirty === null) {
            return null;
        }

        // strip_tags removes all HTML/XML tags.
        // html_entity_decode first so encoded payloads like &#60;script&#62; are caught.
        $decoded = html_entity_decode($dirty, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $stripped = strip_tags($decoded);

        // Re-encode special chars for safe storage/display
        return trim($stripped);
    }
}