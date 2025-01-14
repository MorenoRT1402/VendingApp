<?php

namespace App\Factory\Params;

class VendingProducts {
    public static function get_all() : array{
        return [
            'bebidas' => [
                'refrescos' => [
                    'Coca-Cola',
                    'Pepsi',
                    'Fanta Naranja',
                    'Sprite',
                    'Aquarius',
                ],
                'aguas' => [
                    'Agua Mineral Natural',
                    'Agua con Gas',
                ],
                'zumos' => [
                    'Zumo de Naranja',
                    'Zumo de Manzana',
                    'Zumo Multifrutas',
                ],
                'bebidas_energeticas' => [
                    'Red Bull',
                    'Monster',
                    'Burn',
                ],
                'te_y_cafe' => [
                    'Té Frío Limón',
                    'Café con Leche',
                    'Café Solo',
                ],
            ],
            'snacks_salados' => [
                'patatas_fritas' => [
                    'Patatas Fritas Clásicas',
                    'Patatas Fritas con Sal y Vinagre',
                    'Patatas Fritas con Queso',
                ],
                'frutos_secos' => [
                    'Cacahuetes Salados',
                    'Almendras',
                    'Pistachos',
                    'Mix de Frutos Secos',
                ],
                'otros_salados' => [
                    'Palomitas de Maíz',
                    'Pretzels',
                    'Crackers',
                ],
            ],
            'snacks_dulces' => [
                'chocolates' => [
                    'Chocolate con Leche',
                    'Chocolate Negro',
                    'Chocolate con Avellanas',
                    'Barritas de Chocolate',
                ],
                'galletas' => [
                    'Galletas con Chocolate',
                    'Galletas Integrales',
                    'Galletas de Mantequilla',
                ],
                'caramelos_y_chicles' => [
                    'Caramelos de Menta',
                    'Chicles de Menta',
                    'Caramelos de Fresa',
                ],
                'otros_dulces' => [
                    'Barritas de Cereales',
                    'Magdalenas',
                    'Donuts',
                ],
            ],
            'otros' => [
                'productos_saludables' => [
                    'Fruta Deshidratada',
                    'Barritas Energéticas',
                ],
                'productos_de_higiene' => [
                    'Pañuelos de Papel',
                    'Gel Hidroalcohólico',
                ],
                'otros_articulos' => [
                    'Baterías',
                    'Auriculares',
                ],
            ],
        ];
    }
}
