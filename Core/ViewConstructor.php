<?php

namespace Core;

use Exception;

class ViewConstructor
{
    private static string $basePath = 'layouts/';

    /**
     * @throws Exception
     */
    public static function compile($viewPath, $data = []) : string
    {
        $view = new View(static::getViewFullPath($viewPath), $data);
        $view->process();
        if ($view->getExtends()) {
            $extendedView = new View(static::getViewFullPath($view->getExtends()), [], $view->getSections());
            return $extendedView->process();
        }
        return $view->process();
    }

    public static function getViewFullPath($viewPath): string
    {
        return basePath() . self::$basePath . $viewPath . '.php';
    }
}
