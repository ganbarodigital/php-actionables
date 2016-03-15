<?php

/**
 * Copyright (c) 2016-present Ganbaro Digital Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Libraries
 * @package   Actionables/Values
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-data-containers
 */

namespace GanbaroDigital\Actionables\Values;

/**
 * An Actionable represents:
 *
 * - a callable piece of PHP code
 * - with associated metadata
 *
 * It's the metadata that adds the real value. If your app doesn't need
 * the metadata, you're better off sticking with PHP's native callables.
 */
class Actionable
{
    /**
     * the callable code that we represent
     * @var callable
     */
    private $action;

    /**
     * the full path to the file where $action's code is defined
     * @var string
     */
    private $sourceFilename;

    /**
     * a (possibly empty) list of tags that describe this Actionable
     *
     * @var array
     */
    private $tags = [];

    /**
     * constructor
     *
     * @param callable $action
     *        the callable code that we represent
     * @param string $sourceFilename
     *        the full path to the file where $action's code is defined
     * @param array $tags
     *        a list of tags that describe this Actionable
     */
    public function __construct(callable $action, $sourceFilename, $tags = [])
    {
        $this->action = $action;
        $this->sourceFilename = $sourceFilename;
        $this->tags = array_combine(array_values($tags), array_values($tags));
    }

    /**
     * execute this callable
     *
     * @param  array $params
     *         the parameters to pass into our callable
     * @return mixed
     *         returns whatever our callable returns
     */
    public function __invoke(array $params)
    {
        return call_user_func_array($this->action, $params);
    }

    /**
     * what is the full path to the PHP file where the action's code is defined?
     *
     * @return string
     */
    public function getSourceFilename()
    {
        return $this->sourceFilename;
    }

    /**
     * what is the full list of this Actionable's tags?
     *
     * @return array
     */
    public function getTags()
    {
        return array_values($this->tags);
    }

    /**
     * does this Actionable have a specific tag?
     *
     * @param  string $tagName
     *         the tag that we want to check for
     * @return boolean
     *         TRUE if we have this tag
     *         FALSE otherwise
     */
    public function hasTag($tagName)
    {
        return isset($this->tags[$tagName]);
    }
}
