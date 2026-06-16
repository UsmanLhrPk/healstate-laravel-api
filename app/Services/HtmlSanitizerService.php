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

    public function sanitize(?string $dirty): ?string
    {
        if ($dirty === null) {
            return null;
        }

        return $this->purifier->purify($dirty);
    }
}