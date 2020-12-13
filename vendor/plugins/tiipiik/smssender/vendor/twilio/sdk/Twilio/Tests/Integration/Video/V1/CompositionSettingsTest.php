<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Video\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class CompositionSettingsTest extends HolodeckTestCase {
    public function testFetchRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->video->v1->compositionSettings()->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://video.twilio.com/v1/CompositionSettings/Default'
        ));
    }

    public function testFetchResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "string",
                "aws_credentials_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "encryption_key_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "aws_s3_url": "https://my-super-duper-bucket.s3.amazonaws.com/my/path/",
                "aws_storage_enabled": true,
                "encryption_enabled": true,
                "url": "https://video.twilio.com/v1/CompositionSettings/Default"
            }
            '
        ));

        $actual = $this->twilio->video->v1->compositionSettings()->fetch();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->video->v1->compositionSettings()->create("friendlyName");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = array('FriendlyName' => "friendlyName", );

        $this->assertRequest(new Request(
            'post',
            'https://video.twilio.com/v1/CompositionSettings/Default',
            null,
            $values
        ));
    }

    public function testCreateResponse() {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "friendly_name",
                "aws_credentials_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "encryption_key_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "aws_s3_url": "https://my-super-duper-bucket.s3.amazonaws.com/my/path/",
                "aws_storage_enabled": true,
                "encryption_enabled": true,
                "url": "https://video.twilio.com/v1/CompositionSettings/Default"
            }
            '
        ));

        $actual = $this->twilio->video->v1->compositionSettings()->create("friendlyName");

        $this->assertNotNull($actual);
    }
}