<?php
/**
 * Created by PhpStorm.
 * User: oleksandr
 * Date: 25.05.19
 * Time: 1:57
 */

namespace services;

use helpers\ArrayHelper;

class RestaurantsService
{
    /**
     * @param $resource
     * @return array|null
     * @throws \Exception
     */
    public static function fetchProducts( $resource ): ?array
    {
        $product_list = [];

        while ( ($row = fgetcsv($resource, 1000, ',')) !== false ) {
            $products  = array_filter( array_splice($row, 2), 'strlen');
            $relations = array_splice($row, 0, 2);

            foreach( $products as $product ){
                $product_list[] = ['restaurant_id' => $relations[0], 'price' => $relations[1], 'name' => trim($product)];
            }
        } fclose($resource);

        return $product_list;
    }

    /**
     * @param array $order
     * @param array $restaurants
     * @return array
     */
    public static function filter( array $order, array $restaurants ): array {
        /** remove restaurants **/
        foreach ( $restaurants as $restaurant_id => &$restaurant ){
            if( array_diff ($order, array_column($restaurant, 'name')) ){
                unset($restaurants[$restaurant_id]); continue;
            }

            foreach( $restaurant as $key => $product ){
                if( !in_array($product['name'], $order ) ){
                    unset($restaurant[$key]); continue;
                }
            }
        }
        return $restaurants;
    }

    /**
     * @param array $restaurants
     * @return array|null
     */
    public static function findBetter(array $restaurants ): ?array {
        $better = null;
        foreach ( $restaurants as $restaurant ){
            if( is_null($better) || ArrayHelper::sumColumn($better, 'price') > ArrayHelper::sumColumn($restaurant, 'price') ){ $better = $restaurant; }
        }

        return $better;
    }
}