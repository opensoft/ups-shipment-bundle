<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a full copyright notice, see the LICENSE file.
 */

namespace Opensoft\Bundle\UpsShipmentBundle\Services;

use stdClass;
use Ups\Entity\Shipment;
use Ups\Shipping;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class UpsShipmentService
{
    /**
     * @var Shipping
     */
    private $shippingService;

    public function __construct($upsAccessKey, $upsUserName, $upsPassword, $isProductionMode, $logger)
    {
        $this->shippingService = new Shipping(
            $upsAccessKey,
            $upsUserName,
            $upsPassword,
            $isTestingEnvironment = !$isProductionMode,
            $request = null,
            $logger
        );
    }

    /**
     * Convenience method for one-step Shipment submission
     *
     * Returns stdClass result with fields as documented in UPS Shipping Package XML Developers Guide
     * Most important are:
     *  + /PackageResults/LabelImage/GraphicImage - string of base64 encoded label data
     *  + /ShipmentIdentificationNumber - UPS tracking number
     *
     * @param Shipment $shipment
     * @param string $validationFlag
     * @param stdClass|null $labelSpec
     * @param stdClass|null $receiptSpec
     * @return stdClass
     */
    public function submitShipment(Shipment $shipment, $validationFlag = Shipping::REQ_NONVALIDATE, $labelSpec = null, $receiptSpec = null)
    {
        $confirmResponse = $this->shippingService->confirm($validationFlag, $shipment, $labelSpec, $receiptSpec);

        $acceptResponse = $this->shippingService->accept($confirmResponse->ShipmentDigest);

        return $acceptResponse;
    }

    /**
     * Request for Shipment Confirm
     *
     * Returns stdClass result with fields as documented in UPS Shipping Package XML Developers Guide
     * Most important is:
     *  + /ShipmentDigest - shipment Digest used in next step, the request for Shipment Accept
     *
     * @param Shipment $shipment
     * @param string $validationFlag
     * @param stdClass|null $labelSpec
     * @param stdClass|null $receiptSpec
     * @return stdClass
     */
    public function confirmShipment(Shipment $shipment, $validationFlag = Shipping::REQ_NONVALIDATE, $labelSpec = null, $receiptSpec = null)
    {
        $confirmResponse = $this->shippingService->confirm($validationFlag, $shipment, $labelSpec, $receiptSpec);

        return $confirmResponse;
    }

    /**
     * Request for Shipment Accept
     *
     * Returns stdClass result with fields as documented in UPS Shipping Package XML Developers Guide
     * Most important are:
     *  + /PackageResults/LabelImage/GraphicImage - string of base64 encoded label data
     *  + /ShipmentIdentificationNumber - UPS tracking number
     *
     * @param $shipmentDigest - digest from response to Shipment Confirm request
     * @return stdClass
     */
    public function acceptShipment($shipmentDigest)
    {
        $acceptResponse = $this->shippingService->accept($shipmentDigest);

        return $acceptResponse;
    }
} 
