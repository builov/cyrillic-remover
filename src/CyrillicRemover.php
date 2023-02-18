<?php
namespace Builov\CyrillicRemover;

class CyrillicRemover
{
    private string $str;
    private array $matches = [];
    private string $pattern = '/[авезкмнорстухч]/iu';
    private array $replace_table = [
        'а' => 'a',
        'в' => 'b',
        'е' => 'e',
        'з' => '3', // цифра
        'к' => 'k',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'р' => 'r',
        'с' => 'c',
        'т' => 't',
        'у' => 'u',
        'х' => 'x',
        'ч' => '4' // цифра
    ];

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    public function checkString() {
        preg_match_all($this->pattern, $this->str, $matches);
        $this->matches = $matches[0];
        return count($this->matches);
    }

    public function clear() {
        $str = $this->str;

        foreach ($this->matches as $letter) {
            if (mb_strtoupper($letter) === $letter) {
                $str = str_replace($letter, mb_strtoupper($this->replace_table[mb_strtolower($letter)]), $str);
            } else {
                $str = str_replace($letter, $this->replace_table[$letter], $str);
            }
        }

        return $str;
    }
}