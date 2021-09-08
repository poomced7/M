<?php

class QrCode {

        /**
         * Size in pixels
         *
         * @var string
         */
        var $size = '100x100';

        /**
         * Encoding:
         * 	UTF-8 [Default]
         * 	Shift_JIS
         * 	ISO-8859-1
         *
         * @var string Encoding
         */
        var $encode = 'UTF-8';

        /**
         * Error correction level
         * L - [Default] Allows recovery of up to 7% data loss
         * M - Allows recovery of up to 15% data loss
         * Q - Allows recovery of up to 25% data loss
         * H - Allows recovery of up to 30% data loss
         *
         * @var string Error correction level
         */
        var $error_correction = 'L';

        /**
         * The width of the white border around the data portion of the chart. This is in rows, not in pixels.
         *
         * @var integer
         */
        var $margin = 2;

        /**
         * The Base URL to the QR-Code Generation API
         *
         * @var string
         */
        var $base_url = 'http://chart.googleapis.com/chart?cht=qr&chl=';

        /**
	 * Plain text that will be converted onto qrcode..
	 *
	 * @param string $text Text to encode
	 * @param mixed $options options array, see helper vars for description of parameters
	 */
        function text($text = '', $options = array()) {
                return '<img src="' . $this->base_url . urlencode($text) . $this->_optionsString($options) . '" />';
        }

        /**
	 * Takes the options array,.
	 *
	 * @param mixed $options options array, see helper vars for description of parameters
	 * @return string url parameter string
	 */
        function _optionsString($options) {
                if (!isset($options['size'])) {
                        $options['size'] = $this->size;
                }
                if (!isset($options['encode'])) {
                        $options['encode'] = $this->encode;
                }
                if (!isset($options['error_correction'])) {
                        $options['error_correction'] = $this->error_correction;
                }
                if (!isset($options['margin'])) {
                        $options['margin'] = $this->margin;
                }
                return '&chs=' . $options['size'] . '&choe=' . $options['encode'] . '&chld=' . $options['error_correction'] . '|' . $options['margin'];
        }

}

$qr = new QrCode();
$t12 = $token; 
echo $qr->text("https://amz.jbtap.online/?app=dashboard&token=$t12");?>