<?php

/**
 * Copyright 2023 Flarone B.V.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Flarone\Instagram\Comment;

// other classes we need to use
use Flarone\Instagram\Instagram;
use Flarone\Instagram\Request\Params;
use Flarone\Instagram\Request\Fields;

/**
 * Replies
 *
 * Replies on a specific media.
 *     - Endpoint Format: GET /{ig-comment-id}/replies?fields={fields}&access_token={access-token}
 *     - Endpoint Format: POST /{ig-comment-id}/replies?message={message}&access_token={access-token}
 *     - Facebook docs: https://developers.facebook.com/docs/instagram-api/reference/ig-comment/replies
 *
 * @package     instagram-graph-api
 * @author      Flarone
 * @link        https://github.com/flarone
 * @license     https://opensource.org/licenses/MIT
 * @version     1.0
 */
class Replies extends Comment {
    /**
     * @const Instagram endpoint for the request.
     */
    const ENDPOINT = 'replies';

    /**
     * Contructor for instantiating a new object.
     *
     * @param array $config for the class.
     * @return void
     */
    public function __construct( $config ) {
        // call parent for setup
        parent::__construct( $config );
    }

    /**
     * Create a reply on a comment.
     *
     * @param string $message reply to post.
     * @return Instagram Response.
     */
    public function create( $message ) {
         $postParams = array( // parameters for our endpoint
            'endpoint' => '/' . $this->commentId . '/' . self::ENDPOINT,
            'params' => array(
                Params::MESSAGE => $message
            )
        );

        // ig get request
        $response = $this->post( $postParams );

        // return response
        return $response;
    }

    /**
     * Get replies for a comment.
     *
     * @param array $paramsparams for the GET request.
     * @return Instagram response.
     */
    public function getSelf( $params = array() ) {
        $getParams = array( // parameters for our endpoint
            'endpoint' => '/' . $this->commentId . '/' . $this->endpoint,
            'params' => $params ? $params : Params::getFieldsParam( Fields::getDefaultCommentFields( false ) )
        );

        // ig get request
        $response = $this->get( $getParams );

        // return response
        return $response;
    }
}

?>