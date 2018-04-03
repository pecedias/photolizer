<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/pubsub/v1/pubsub.proto

namespace Google\Cloud\PubSub\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request for the Publish method.
 *
 * Generated from protobuf message <code>google.pubsub.v1.PublishRequest</code>
 */
class PublishRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The messages in the request will be published on this topic.
     * Format is `projects/{project}/topics/{topic}`.
     *
     * Generated from protobuf field <code>string topic = 1;</code>
     */
    private $topic = '';
    /**
     * The messages to publish.
     *
     * Generated from protobuf field <code>repeated .google.pubsub.v1.PubsubMessage messages = 2;</code>
     */
    private $messages;

    public function __construct() {
        \GPBMetadata\Google\Pubsub\V1\Pubsub::initOnce();
        parent::__construct();
    }

    /**
     * The messages in the request will be published on this topic.
     * Format is `projects/{project}/topics/{topic}`.
     *
     * Generated from protobuf field <code>string topic = 1;</code>
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * The messages in the request will be published on this topic.
     * Format is `projects/{project}/topics/{topic}`.
     *
     * Generated from protobuf field <code>string topic = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setTopic($var)
    {
        GPBUtil::checkString($var, True);
        $this->topic = $var;

        return $this;
    }

    /**
     * The messages to publish.
     *
     * Generated from protobuf field <code>repeated .google.pubsub.v1.PubsubMessage messages = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * The messages to publish.
     *
     * Generated from protobuf field <code>repeated .google.pubsub.v1.PubsubMessage messages = 2;</code>
     * @param \Google\Cloud\PubSub\V1\PubsubMessage[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setMessages($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\PubSub\V1\PubsubMessage::class);
        $this->messages = $arr;

        return $this;
    }

}

