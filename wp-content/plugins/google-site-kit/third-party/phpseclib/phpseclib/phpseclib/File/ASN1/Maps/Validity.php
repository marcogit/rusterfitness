<?php

/**
 * Validity
 *
 * PHP version 5
 *
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2016 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */
namespace Google\Site_Kit_Dependencies\phpseclib3\File\ASN1\Maps;

use Google\Site_Kit_Dependencies\phpseclib3\File\ASN1;
/**
 * Validity
 *
 * @author  Jim Wigginton <terrafrost@php.net>
 */
abstract class Validity
{
    const MAP = ['type' => \Google\Site_Kit_Dependencies\phpseclib3\File\ASN1::TYPE_SEQUENCE, 'children' => ['notBefore' => \Google\Site_Kit_Dependencies\phpseclib3\File\ASN1\Maps\Time::MAP, 'notAfter' => \Google\Site_Kit_Dependencies\phpseclib3\File\ASN1\Maps\Time::MAP]];
}
