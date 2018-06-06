<?php

namespace DataMod;

use Genesis\SQLExtensionWrapper\BaseProvider;

/**
 * How to use this file to create your own DataMod.
 * 1 - Change the name of the class to reflect the file name.
 * 2 - Set the table name in the getBaseTable() method.
 * 3 - Set the data mapping in the getDataMapping() method.
 * 3.1 - The mapping is in the format '<Your-Label>' => '<Table-Column>'
 * 4 - Set any default values for the table columns.
 * 4.1 - Such as foreign keys, default strings.
 * 4.2 - Your original data set will be passed in as the argument.
 * 4.3 - You can use other DataMods in here.
 * 4.4 - The defaults cannot override any original data, but the original will override the default.
 * 4.5 - Data format '<Your-Label>' => '<Default-Value>'
 */

/**
 * PhoneBooking extends DatabaseManipulator class.
 */
class PhoneBooking extends BaseProvider
{
    /**
     * @return string
     */
    public static function getBaseTable()
    {
        return 'PhoneBookings';
    }

    /**
     * @return array
     */
    public static function getDataMapping()
    {
        return [
            'PhoneBookingId' => 'PhoneBookingId',
            'SubscriberId' => 'SubscriberId',
            'CruiseOperatorId' => 'CruiseOperatorId',
            'ConsultantId' => 'ConsultantId',
            'CruiseShipId' => 'CruiseShipId',
            'SailingDate' => 'SailingDate',
            'BookingStatusCode' => 'BookingStatusCode',
            'CruiseBookingCode' => 'CruiseBookingCode',
            'Duration' => 'Duration',
            'CruiseLineReference' => 'CruiselineRef',
            'InvoiceDue' => 'InvoiceDue'
        ];
    }

    /**
     * Set default values and foreign key values here.
     *
     * @param array $data
     *
     * @return array
     */
    public static function getDefaults(array $data)
    {
        return [
            'SubscriberId' => 8,
            'CruiseOperatorId' => 7,
            'ConsultantId' => Consultant::getValue('ConsultantId', 7),
            'CruiseShipId' => 7,
            'BookingStatusCode' => 'BOOKED',
            'CruiseBookingCode' => time(),
            'Duration' => 7,
        ];
    }
}
