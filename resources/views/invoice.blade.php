<?xml version="1.0" encoding="UTF-8"?>
<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:oasis:names:specification:ubl:schema:xsd:CoreComponentParameters-2" xmlns:sdt="urn:oasis:names:specification:ubl:schema:xsd:SpecializedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 UBL-Invoice-2.0.xsd">
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>OIOUBL-2.02</cbc:CustomizationID>
    <cbc:ProfileID schemeAgencyID="320" schemeID="urn:oioubl:id:profileid-1.2">urn:www.nesubl.eu:profiles:profile5:ver2.0</cbc:ProfileID>
    <cbc:ID>{{ array_get($data, 'ID') }}</cbc:ID>
    <cbc:CopyIndicator>{{ array_get($data, 'CopyIndicator') }}</cbc:CopyIndicator>
    <cbc:UUID>{{ array_get($data, 'UUID') }}</cbc:UUID>
    <cbc:IssueDate>{{ array_get($data, 'IssueDate') }}</cbc:IssueDate>
    <cbc:IssueTime>{{ array_get($data, 'IssueTime') }}</cbc:IssueTime>
    <cbc:InvoiceTypeCode listAgencyID="320" listID="urn:oioubl:codelist:invoicetypecode-1.1">{{ array_get($data, 'InvoiceTypeCode') }}</cbc:InvoiceTypeCode>
    @foreach(array_get($data, 'Note', []) as $note)
        <cbc:Note languageID="{{ $note->language() }}">{{ (string) $note }}</cbc:Note>
    @endforeach
    <cbc:TaxPointDate>{{ array_get($data, 'TaxPointDate') }}</cbc:TaxPointDate>
    <cbc:DocumentCurrencyCode>{{ array_get($data, 'DocumentCurrencyCode') }}</cbc:DocumentCurrencyCode>
    <cbc:TaxCurrencyCode>{{ array_get($data, 'TaxCurrencyCode') }}</cbc:TaxCurrencyCode>
    <cbc:PricingCurrencyCode>{{ array_get($data, 'PricingCurrencyCode') }}</cbc:PricingCurrencyCode>
    <cbc:PaymentCurrencyCode>{{ array_get($data, 'PaymentCurrencyCode') }}</cbc:PaymentCurrencyCode>
    <cbc:PaymentAlternativeCurrencyCode>{{ array_get($data, 'PaymentAlternativeCurrencyCode') }}</cbc:PaymentAlternativeCurrencyCode>
    <cbc:AccountingCostCode>{{ array_get($data, 'AccountingCostCode') }}</cbc:AccountingCostCode>
    <cbc:AccountingCost>{{ array_get($data, 'AccountingCost') }}</cbc:AccountingCost>
    <cbc:LineCountNumeric>{{ array_get($data, 'LineCountNumeric') }}</cbc:LineCountNumeric>
    <cac:OrderReference>
        <cbc:ID>{{ array_get($order_reference, 'OrderReference.ID') }}</cbc:ID>
        <cbc:IssueDate>{{ array_get($order_reference, 'OrderReference.IssueDate') }}</cbc:IssueDate>
    </cac:OrderReference>
    @foreach(array_get($data, 'AdditionalDocumentReference', []) as $reference)
        <cac:AdditionalDocumentReference>
            <cbc:ID>{{ array_get($reference, 'ID') }}</cbc:ID>
            <cbc:UUID>{{ array_get($reference, 'UUID') }}</cbc:UUID>
            <cbc:IssueDate>{{ array_get($reference, 'IssueDate') }}</cbc:IssueDate>
            <cbc:DocumentTypeCode listAgencyID="320" listID="urn:oioubl:codelist:responsedocumenttypecode-1.2">{{ array_get($reference, 'DocumentTypeCode') }}</cbc:DocumentTypeCode>
        </cac:AdditionalDocumentReference>
    @endforeach
    <cac:AccountingSupplierParty>
        <cac:Party>
            <cbc:EndpointID schemeID="DK:CVR">DK{{ array_get($sender, 'cvr') }}</cbc:EndpointID>
            <cac:PartyIdentification>
                <cbc:ID schemeID="DK:CVR">DK{{ array_get($sender, 'cvr') }}</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name>{{ array_get($sender, 'name') }}</cbc:Name>
            </cac:PartyName>
            <cac:PostalAddress>
                <cbc:AddressFormatCode listAgencyID="320" listID="urn:oioubl:codelist:addressformatcode-1.1">StructuredDK</cbc:AddressFormatCode>
                <cbc:StreetName>{{ array_get($sender, 'address.street_name') }}</cbc:StreetName>
                <cbc:BuildingNumber>{{ array_get($sender, 'address.building_number') }}</cbc:BuildingNumber>
                <cbc:CityName>{{ array_get($sender, 'address.city_name') }}</cbc:CityName>
                <cbc:PostalZone>{{ array_get($sender, 'address.postal_zone') }}</cbc:PostalZone>
                <cac:Country>
                    <cbc:IdentificationCode>{{ array_get($sender, 'address.country_code') }}</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName>{{ array_get($sender, 'name') }}</cbc:RegistrationName>
                <cbc:CompanyID schemeID="DK:CVR">DK{{ array_get($sender, 'cvr') }}</cbc:CompanyID>
            </cac:PartyLegalEntity>
            <cac:Contact>
                <cbc:Name>{{ array_get($sender, 'contact.name') }}</cbc:Name>
                <cbc:Telephone>{{ array_get($sender, 'contact.phone') }}</cbc:Telephone>
                <cbc:ElectronicMail>{{ array_get($sender, 'contact.email') }}</cbc:ElectronicMail>
            </cac:Contact>
        </cac:Party>
    </cac:AccountingSupplierParty>
    <cac:AccountingCustomerParty>
        <cac:Party>
            <cbc:EndpointID schemeAgencyID="9" schemeID="GLN">{{ array_get($recipient, 'ean') }}</cbc:EndpointID>
            <cac:PartyIdentification>
                <cbc:ID schemeAgencyID="9" schemeID="GLN">{{ array_get($recipient, 'ean') }}</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name>{{ array_get($recipient, 'name') }}</cbc:Name>
            </cac:PartyName>
            <cac:PostalAddress>
                <cbc:AddressFormatCode listAgencyID="320" listID="urn:oioubl:codelist:addressformatcode-1.1">StructuredDK</cbc:AddressFormatCode>
                <cbc:StreetName>{{ array_get($recipient, 'address.street_name') }}</cbc:StreetName>
                <cbc:BuildingNumber>{{ array_get($recipient, 'address.building_number') }}</cbc:BuildingNumber>
                <cbc:CityName>{{ array_get($recipient, 'address.city_name') }}</cbc:CityName>
                <cbc:PostalZone>{{ array_get($recipient, 'address.postal_zone') }}</cbc:PostalZone>
                <cac:Country>
                    <cbc:IdentificationCode>{{ array_get($recipient, 'address.country_code') }}</cbc:IdentificationCode>
                </cac:Country>
            </cac:PostalAddress>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName>{{ array_get($recipient, 'name') }}</cbc:RegistrationName>
                <cbc:CompanyID schemeID="DK:CVR">DK{{ array_get($recipient, 'cvr') }}</cbc:CompanyID>
            </cac:PartyLegalEntity>
            <cac:Contact>
                <cbc:ID>{{ array_get($recipient, 'contact.id') }}</cbc:ID>
                <cbc:Name>{{ array_get($recipient, 'contact.name') }}</cbc:Name>
            </cac:Contact>
        </cac:Party>
    </cac:AccountingCustomerParty>
    <cac:PaymentMeans>
        <cbc:ID>1</cbc:ID>
        <cbc:PaymentMeansCode>93</cbc:PaymentMeansCode>
        <cbc:PaymentDueDate>{{ array_get($payment_request, 'due_date') }}</cbc:PaymentDueDate>
        <cbc:PaymentChannelCode listID="urn:oioubl:codelist:paymentchannelcode-1.1">DK:FIK</cbc:PaymentChannelCode>
        <cbc:InstructionID>{{ $fik_number }}</cbc:InstructionID>
        <cbc:PaymentID>{{ array_get($payment_means, 'payment_id') }}</cbc:PaymentID>
        <cac:CreditAccount>
            <cbc:AccountID>{{ array_get($payment_means, 'credit_account_id') }}</cbc:AccountID>
        </cac:CreditAccount>
    </cac:PaymentMeans>
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="DKK">{{ number_format(array_get($data, 'vat'), 2, '.', '') }}</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="DKK">{{ number_format(array_get($data, 'total'), 2, '.', '') }}</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="DKK">{{ number_format(array_get($data, 'vat'), 2, '.', '') }}</cbc:TaxAmount>
            <cac:TaxCategory>
                <cbc:ID schemeID="urn:oioubl:id:taxcategoryid-1.1" schemeAgencyID="320">StandardRated</cbc:ID>
                <cbc:Percent>25</cbc:Percent>
                <cac:TaxScheme>
                    <cbc:ID schemeID="urn:oioubl:id:taxschemeid-1.1">63</cbc:ID>
                    <cbc:Name>Moms</cbc:Name>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID="DKK">{{ number_format(array_get($data, 'total'), 2, '.', '') }}</cbc:LineExtensionAmount>
        <cbc:PayableAmount currencyID="DKK">{{ number_format(array_get($data, 'total_vat'), 2, '.', '') }}</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    @foreach(array_get($data, 'lines') as $line)
        <cac:InvoiceLine>
            <cbc:ID>{{ array_get($line, 'id') }}</cbc:ID>
            <cbc:InvoicedQuantity unitCode="{{ array_get($line, 'unit', 'EA') }}">{{ array_get($line, 'quantity') }}</cbc:InvoicedQuantity>
            <cbc:LineExtensionAmount currencyID="DKK">{{ number_format(array_get($line, 'price'), 2, '.', '') }}</cbc:LineExtensionAmount>
            <cac:TaxTotal>
                <cbc:TaxAmount currencyID="DKK">{{ number_format(array_get($line, 'vat'), 2, '.', '') }}</cbc:TaxAmount>
                <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID="DKK">{{ number_format(array_get($line, 'price'), 2, '.', '') }}</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID="DKK">{{ number_format(array_get($line, 'vat'), 2, '.', '') }}</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cbc:ID schemeID="urn:oioubl:id:taxcategoryid-1.1" schemeAgencyID="320">StandardRated</cbc:ID>
                        <cbc:Percent>25</cbc:Percent>
                        <cac:TaxScheme>
                            <cbc:ID schemeID="urn:oioubl:id:taxschemeid-1.1">63</cbc:ID>
                            <cbc:Name>Moms</cbc:Name>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                </cac:TaxSubtotal>
            </cac:TaxTotal>
            <cac:Item>
                <cbc:Name>{{ array_get($line, 'display_name') }}</cbc:Name>
                <cac:SellersItemIdentification>
                    <cbc:ID schemeAgencyID="9" schemeID="GTIN">{{ array_get($line, 'display_name') }}</cbc:ID>
                </cac:SellersItemIdentification>
            </cac:Item>
            <cac:Price>
                <cbc:PriceAmount currencyID="DKK">{{ array_get($line, 'unit_price') }}</cbc:PriceAmount>
            </cac:Price>
        </cac:InvoiceLine>
    @endforeach
</Invoice>
