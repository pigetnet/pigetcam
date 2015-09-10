<?php
/**
 * A helper class to deal with HTTP requests/responses via cURL,
 * particularly "multipart/x-mixed-replace" mimetype.
 *
 * @version 0.1.0
 * @since 2012-12-19
 * @author nanawel {at} gmail {dot} com
 * @license BSD
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *     (1) Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *     (2) Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *     (3)The name of the author may not be used to
 *     endorse or promote products derived from this software without
 *     specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT,
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
 * STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
class HttpHelper
{
    /**
     * @see http://www.php.net/manual/en/function.http-parse-headers.php#77241
     * @param string $rawHeaders
     * @return array
     */
    public static function parseHttpHeaders($headers)
    {
        $retVal = array();
        $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $headers));
        foreach ($fields as $field) {
            if (preg_match('/([^:]+): (.+)/m', $field, $match)) {
                $match[1] = preg_replace('/(?<=^|[\x09\x20\x2D])./e', 'strtoupper("\0")', strtolower(trim($match[1])));
                if (isset($retVal[$match[1]])) {
                    $retVal[$match[1]] = array($retVal[$match[1]], $match[2]);
                } else {
                    $retVal[$match[1]] = trim($match[2]);
                }
            }
        }
        return $retVal;
    }
    
    public static function parseHttpResponse($response)
    {
        $content = explode("\r\n\r\n", $response);
        $headers = array_shift($content);
        return array(
            'headers' => $headers,
            'body'    => join("\r\n\r\n", $content)
        );
    }
    
    public static function getMultipartXMixedReplacePart($host, $port, $path, $timeout = 30)
    {
        $fp = fsockopen($host, $port, $errno, $errstr, 30);

        if (!$fp) {
            die("ERROR: Can't connect to host/port");
        }
        fputs($fp, "GET $path HTTP/1.0\r\n\r\n");
        
        $imageData = null;
        $imageSize = null;
        
        // Extract HTTP header
        $rawHeaders = '';
        do {
            $line = fgets($fp, 1024);
            $rawHeaders .= $line . "\r\n";
        } while (trim($line));
        
        $headers = self::parseHttpHeaders($rawHeaders);
        if (!isset($headers['Content-Type'])) {
            die("ERROR: Can't find 'Content-Type' directive in header");
        }
        
        // Extract part header
        $rawPartHeaders = '';
        do {
            $line = fgets($fp, 4096);
            $rawPartHeaders .= $line . "\r\n";
        } while (trim($line));
        
        $partHeaders = self::parseHttpHeaders($rawPartHeaders);
        if (!isset($partHeaders['Content-Length'])) {
            die("ERROR: Can't find 'Content-Length' directive in header");
        }
        $partContentType = $partHeaders['Content-Type'];
        $partSize = (int) $partHeaders['Content-Length'];
        
        // Extract part body
        $partBody = stream_get_contents($fp, $partSize);
        
        fclose($fp);
        
        return array(
            'content-type' => $partContentType,
            'data' => $partBody
        );
    }
    
    public static function proxypassMultipartXMixedReplacePart($host, $port, $path, $timeout = 30)
    {
        $fp = fsockopen($host, $port, $errno, $errstr, 30);

        $contentType = null;
        
        // Skip headers
        while ($line = trim(fgets($fp, 1024))) {
            if (preg_match('#(Content-Type:.*)#i', $line, $matches)) {
                $contentType = $matches[1];
            }
        }
        
        header("Cache-Control: no-cache");
        header("Cache-Control: private");
        header("Pragma: no-cache");
        header($contentType);
        
        fpassthru($fp);
        fclose($fp);
    }
}
