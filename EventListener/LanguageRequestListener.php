<?php

/*
 * This file is part of the DunglasApiBundle package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dunglas\ApiBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Chooses the language to user according to the Accept header and supported languages.
 *
 * @author Pierrick VIGNAND <pierrick.vignand@gmail.com>
 */
class LanguageRequestListener
{
    /**
     * @var string[]
     */
    private $supportedLanguages;

    /**
     * @param string[]                  $supportedLanguages
     */
    public function __construct($supportedLanguages)
    {
        $this->supportedLanguages = $supportedLanguages;
    }

    /**
     * Assign the format to use to the _api_language Request attribute.
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        if (!$request->attributes->get('_resource_type')) {
            return;
        }

        $languages = $request->getLanguages();
        if (!empty($languages)) {
            if ($language = $request->getPreferredLanguage($this->supportedLanguages)) {
                // Don't use Request locale property, because when language header is not set, all translations are returned
                $request->attributes->set('_api_language', $language);
                // Set Request locale for consistency
                $request->setLocale($language);
            }
        }
    }
}
