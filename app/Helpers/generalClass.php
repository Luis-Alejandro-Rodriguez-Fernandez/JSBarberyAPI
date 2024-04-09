<?php


namespace App\Helpers;


class generalClass
{

    public $days = [
        0 => 'Lunes',
        1 => 'Martes',
        2 => 'Miercoles',
        3 => 'Jueves',
        4 => 'Viernes',
        5 => 'Sabado',
        6 => 'Domingo',
    ];
    public $month = [
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre',
    ];

    public function responseToApp($status, $data, $message = "")
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ]);
    }

    public function parseFecha(
        ?string $fecha,
        string  $formato = 'd/m/Y',
        string  $formatoOrdenar = 'U'
    ): array
    {
        return [
            'original' => $fecha,
            'ordenar' => $fecha ? date($formatoOrdenar, strtotime($fecha)) : '',
            'ver' => $fecha ? date($formato, strtotime($fecha)) : '',
        ];
    }

    public function getMonths()
    {
        return $this->month;
    }

    /**
     * Devuelve un dato numerico parseado para datatables
     *
     * @param $valor
     * @param null $simbolo
     * @param int $decimales
     * @param bool $formatOrden
     * @return array
     */
    public function parseDatoNumerico($valor, $simbolo = null, int $decimales = 2, bool $formatOrden = false): array
    {

        $power = 10 ** $decimales;
        $valor_format = (int)($valor * $power) / $power;

        return [
            'ver' => number_format($valor_format, $decimales, ',', '.') . $simbolo,
            'ver_mas' => number_format($valor_format, 5, ',', '.') . $simbolo,
            'ordenar' => $formatOrden ? number_format($valor_format, $decimales, '.', '') : $valor_format,
            'base' => $valor_format,
            'original' => $valor
        ];
    }

    public function parseMinutosToStringTime(int $minutes): string
    {
        $stringDuration = "";
        $hours = intval($minutes / 60);
        $minutesLeft = $minutes % 60;

        if ($hours > 0) {
            $stringDuration .= "$hours Horas ";
        }

        if ($hours > 0 && $minutesLeft > 0) {
            $stringDuration .= "y ";
        }

        if ($minutesLeft > 0) {
            $stringDuration .= "$minutesLeft minutos";
        }

        return $stringDuration;
    }
}
