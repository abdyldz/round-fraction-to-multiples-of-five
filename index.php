<?php

/**
 * @param $sayi
 * @param string $seperator
 * @return float|int
 *
 * Fiyat gösteriminde son haneyi sürekli 5 ya da 0 olacak şekilde yukarı yuvarlıyor.
 * 99.99 => 100
 * 10.02 => 10.05
 * 0.1 => 0.5
 */
function roundPriceToMultiplesOfFive($number, $seperator=".")
{
    $roundedNumber = $number;

    $parsedNumber = explode($seperator,$number);

    if($parsedNumber[1]){
        $fractionLength =  strlen($parsedNumber[1]);
        $fractionLastDigit = substr($parsedNumber[1],-1);

        if(in_array($fractionLastDigit,[0,5]))
            return number_format($roundedNumber,2,".","");

        $x = (10 - $fractionLastDigit);
        $y = ( 5 - $fractionLastDigit);

        $addToNumber = $x < 5 ? $x : abs($y);

        $roundedNumber = $number + ($addToNumber / pow(10,$fractionLength));
    }
    return number_format($roundedNumber,2,".","");
}