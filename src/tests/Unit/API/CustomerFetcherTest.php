<?php

namespace Tests\Unit\API;

use App\Facades\CustomerFetcherFacade as CustomerFetcher;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CustomerFetcherTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    public function test_customer_data_should_be_returned()
    {
        Http::fake([
            '*' => Http::response([
                'customers' => $response = [
                    [
                        'name' => $this->faker->name(),
                        'email' => $this->faker->safeEmail(),
                        'phone' => $this->faker->phoneNumber(),
                        'dateOfBirth' => $this->faker->date(),
                        'lastInvoiceDate' => $this->faker->dateTime()->format(Carbon::DEFAULT_TO_STRING_FORMAT),
                        'lastLoginDateTime' => $this->faker->dateTime()->format(Carbon::DEFAULT_TO_STRING_FORMAT),
                    ],
                    [
                        'name' => $this->faker->name(),
                        'email' => $this->faker->safeEmail(),
                        'phone' => $this->faker->phoneNumber(),
                        'dateOfBirth' => $this->faker->date(),
                        'lastInvoiceDate' => $this->faker->dateTime()->format(Carbon::DEFAULT_TO_STRING_FORMAT),
                        'lastLoginDateTime' => $this->faker->dateTime()->format(Carbon::DEFAULT_TO_STRING_FORMAT),
                    ],
                ],
                'unneeded_index' => 123,
            ])
        ]);

        $result = CustomerFetcher::fetch();

        $this->assertSame($response, $result->toArray());
    }

    #[DataProvider('errorCodesDataProvider')]
    public function test_a_known_error_should_be_thrown_when_a_connection_issue_happens(
        callable $error,
        string $message,
    ): void {
        Http::fake(['*' => $error()]);

        try {
            CustomerFetcher::fetch();

            $this->fail('An exception should have been thrown');
        } catch (ConnectionException|RequestException $exception) {
            $this->assertSame($message, $exception->getMessage());
        }
    }

    /**
     * @return array<string, array<int, int>>
     */
    public static function errorCodesDataProvider(): array
    {
        return [
            'Unauthorized' => [
                fn () => Http::response(status: Response::HTTP_UNAUTHORIZED),
                'HTTP request returned status code ' . Response::HTTP_UNAUTHORIZED,
            ],
            'Forbidden' => [
                fn () => Http::response(status: Response::HTTP_FORBIDDEN),
                'HTTP request returned status code ' . Response::HTTP_FORBIDDEN,
            ],
            'Not Found' => [
                fn () => Http::response(status: Response::HTTP_NOT_FOUND),
                'HTTP request returned status code ' . Response::HTTP_NOT_FOUND,
            ],
            'Server Error' => [
                fn () => Http::response(status: Response::HTTP_INTERNAL_SERVER_ERROR),
                'HTTP request returned status code ' . Response::HTTP_INTERNAL_SERVER_ERROR,
            ],
            'Service Unavailable' => [
                fn () => Http::response(status: Response::HTTP_SERVICE_UNAVAILABLE),
                'HTTP request returned status code ' . Response::HTTP_SERVICE_UNAVAILABLE,
            ],
            'Gateway Timeout' => [
                fn () => Http::response(status: Response::HTTP_GATEWAY_TIMEOUT),
                'HTTP request returned status code ' . Response::HTTP_GATEWAY_TIMEOUT,
            ],
            'API Host Unreachable' => [
                fn () => Http::failedConnection('Connection failed'),
                'Connection failed',
            ]
        ];
    }
}
