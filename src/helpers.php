<?php

/**
 * [Formata data]
 * 
 * @param  string $date [data]
 * @return string       [data formatada]
 */
function dateParse($date)
{
	$dateArray = explode('/', $date);
	$dateArray = array_reverse($dateArray);

	return implode('-', $dateArray);
}

/**
 * [Formata numeros]
 * 
 * @param  string $number [numero]
 * @return string         [numero formatado]
 */
function numberParse($number)
{
	$newNumber = str_replace('.', '', $number);
	$newNumber = str_replace(',', '.', $newNumber);

	return $newNumber;
}