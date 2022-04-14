<?php

namespace Core\Routing;

use Exception;

class ViewConstructor
{
    private static string $basePath = 'layouts/';

    /**
     * Compiles views from the top one down by extended views chain.
     * @throws Exception
     */
    public static function compile($viewPath, $data = []) : string
    {
        $view = new View(static::getViewFullPath($viewPath), $data);
        $data = $view->process();
        if ($view->getExtendedView()) {
            return self::processExtendedView($view);
        }
        return $data;
    }

    /**
     * @throws Exception
     */
    protected static function processExtendedView(View $view): string
    {
        $extendedView = new View(static::getViewFullPath($view->getExtendedView()), [], $view->getSections(), $view->getStacks());
        $data = $extendedView->process();
        if ($extendedView->getExtendedView()) {
            return static::processExtendedView($extendedView);
        }
        return $data;
    }

    public static function getViewFullPath($viewPath): string
    {
        return basePath() . self::$basePath . $viewPath . '.php';
    }
}
