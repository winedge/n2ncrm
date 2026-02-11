<?php
/**
 * Concord CRM - https://www.concordcrm.com
 *
 * @version   1.6.0
 *
 * @link      Releases - https://www.concordcrm.com/releases
 * @link      Terms Of Service - https://www.concordcrm.com/terms
 *
 * @copyright Copyright (c) 2022-2025 KONKORD DIGITAL
 */

namespace Modules\MailClient\Tests\Unit;

use Modules\MailClient\Client\Client;
use Modules\MailClient\Client\Contracts\Connectable;
use Modules\MailClient\Client\Imap\Config;
use Modules\MailClient\Client\Imap\ImapClient;
use Modules\MailClient\Client\Imap\SmtpClient;
use Modules\MailClient\Client\Imap\SmtpConfig;
use Tests\TestCase;

class ClientConnectableTest extends TestCase
{
    public function test_client_implements_connectable_interface(): void
    {
        $imapConfig = new Config(
            'imap.example.com',
            993,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $smtpConfig = new SmtpConfig(
            'smtp.example.com',
            465,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $imapClient = new ImapClient($imapConfig);
        $smtpClient = new SmtpClient($smtpConfig);
        $client = new Client($imapClient, $smtpClient);

        $this->assertInstanceOf(Connectable::class, $client);
    }

    public function test_client_has_connect_method(): void
    {
        $imapConfig = new Config(
            'imap.example.com',
            993,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $smtpConfig = new SmtpConfig(
            'smtp.example.com',
            465,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $imapClient = new ImapClient($imapConfig);
        $smtpClient = new SmtpClient($smtpConfig);
        $client = new Client($imapClient, $smtpClient);

        $this->assertTrue(method_exists($client, 'connect'));
    }

    public function test_client_has_test_connection_method(): void
    {
        $imapConfig = new Config(
            'imap.example.com',
            993,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $smtpConfig = new SmtpConfig(
            'smtp.example.com',
            465,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $imapClient = new ImapClient($imapConfig);
        $smtpClient = new SmtpClient($smtpConfig);
        $client = new Client($imapClient, $smtpClient);

        $this->assertTrue(method_exists($client, 'testConnection'));
    }

    public function test_client_get_config_returns_imap_config(): void
    {
        $imapConfig = new Config(
            'imap.example.com',
            993,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $smtpConfig = new SmtpConfig(
            'smtp.example.com',
            465,
            'ssl',
            'test@example.com',
            false,
            'test@example.com',
            'password'
        );

        $imapClient = new ImapClient($imapConfig);
        $smtpClient = new SmtpClient($smtpConfig);
        $client = new Client($imapClient, $smtpClient);

        $this->assertSame($imapConfig, $client->getConfig());
    }
}
