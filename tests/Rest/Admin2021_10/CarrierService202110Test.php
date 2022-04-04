<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_10\CarrierService;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class CarrierService202110Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-10";

        $this->test_session = new Session("session_id", "test-shop.myshopify.io", true, "1234");
        $this->test_session->setAccessToken("this_is_a_test_token");
    }

    /**

     *
     * @return void
     */
    public function test_1(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["carrier_service" => ["id" => 1036894956, "name" => "Shipping Rate Provider", "active" => true, "service_discovery" => true, "carrier_service_type" => "api", "admin_graphql_api_id" => "gid://shopify/DeliveryCarrierService/1036894956", "format" => "json", "callback_url" => "http://shippingrateprovider.com/"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/carrier_services.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["carrier_service" => ["name" => "Shipping Rate Provider", "callback_url" => "http://shippingrateprovider.com", "service_discovery" => true]]),
            ),
        ]);

        $carrier_service = new CarrierService($this->test_session);
        $carrier_service->name = "Shipping Rate Provider";
        $carrier_service->callback_url = "http://shippingrateprovider.com";
        $carrier_service->service_discovery = true;
        $carrier_service->save();
    }

    /**

     *
     * @return void
     */
    public function test_2(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["carrier_services" => [["id" => 1036894958, "name" => "Purolator", "active" => true, "service_discovery" => true, "carrier_service_type" => "api", "admin_graphql_api_id" => "gid://shopify/DeliveryCarrierService/1036894958", "format" => "json", "callback_url" => "http://example.com/"], ["id" => 260046840, "name" => "ups_shipping", "active" => true, "service_discovery" => true, "carrier_service_type" => "legacy", "admin_graphql_api_id" => "gid://shopify/DeliveryCarrierService/260046840"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/carrier_services.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CarrierService::all(
            $this->test_session,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_3(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["carrier_service" => ["active" => false, "id" => 1036894957, "name" => "Some new name", "service_discovery" => true, "carrier_service_type" => "api", "admin_graphql_api_id" => "gid://shopify/DeliveryCarrierService/1036894957", "format" => "json", "callback_url" => "http://example.com/"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/carrier_services/1036894957.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["carrier_service" => ["id" => 1036894957, "name" => "Some new name", "active" => false]]),
            ),
        ]);

        $carrier_service = new CarrierService($this->test_session);
        $carrier_service->id = 1036894957;
        $carrier_service->name = "Some new name";
        $carrier_service->active = false;
        $carrier_service->save();
    }

    /**

     *
     * @return void
     */
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["carrier_service" => ["id" => 1036894959, "name" => "Purolator", "active" => true, "service_discovery" => true, "carrier_service_type" => "api", "admin_graphql_api_id" => "gid://shopify/DeliveryCarrierService/1036894959", "format" => "json", "callback_url" => "http://example.com/"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/carrier_services/1036894959.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CarrierService::find(
            $this->test_session,
            1036894959,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_5(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/carrier_services/1036894960.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CarrierService::delete(
            $this->test_session,
            1036894960,
            [],
            [],
        );
    }

}
