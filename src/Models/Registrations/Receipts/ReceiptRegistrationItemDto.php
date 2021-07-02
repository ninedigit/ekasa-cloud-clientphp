<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts;
use NineDigit\eKasa\Cloud\ApiClient\Models;

final class ReceiptRegistrationItemDto {
    /**
     * Typ položky dokladu
     * @var ReceiptItemType
     * @example Positive
     */
    public string $type;
    /**
     * Označenie tovaru alebo služby.
     * Neprázdny textový reťazec s maximálnou dĺžkou 255 znakov.
     * @example Coca cola
     */
    public string $name;
    /**
     * Celková cena tovaru alebo služby s presnosťou na dve desatinné miesta.
     * Číslo v rozsahu -10000000 až 10000000 s presnosťou na dve desatinné miesta.
     * Celková cena musí byť zhodná s výsledkom vynásobenia jednotkovej ceny a množstva.
     * @example 30.00
     */
    public float $price;
    /**
     * Jednotková cena tovaru alebo služby v EUR s presnosťou na šesť desatinných miest.
     * Číslo v rozsahu -10000000 až 10000000 s presnosťou na šesť desatinných miest.
     * Položka typu Positive musí mať kladnú hodnotu. Položka typu ReturnedContainer,
     * Returned, Discount, Advance, Voucher musí mať zápornú hodnotu.
     * @example 15.00
     */
    public float $unitPrice;
    /**
     * Množstvo tovaru alebo rozsah služby
     */
    public Models\QuantityDto $quantity;
    /**
     * Sadzba dane z pridanej hodnoty.
     * Sadzba nadobúda hodnoty 20.00, 10.00 alebo 0.00.
     * @example 20.00
     */
    public float $vatRate;
    /**
     * Číslo dokladu, ku ktorému sa vzťahuje oprava alebo vrátenie položky
     * Číslo dokladu ak sa jedná o položku typu Correction alebo Return alebo 
     * null v opačnom prípade.
     * V prípade, ak pôvodný doklad obsahuje unikátny identifikátor dokladu,
     * ako referenčné číslo dokladu sa uvedie tento identifikátor. V prípade,
     * ak pôvodný doklad neobsahuje unikátny identifikátor dokladu, ako
     * referenčné číslo dokladu sa uvedie OKP.V prípade pôvodného dokladu
     * vyhotoveného ERP ako referenčné číslo dokladu je uvedené poradové číslo
     * pokladničného dokladu.
     * @example O-7DBCDA8A56EE426DBCDA8A56EE426D1A
     */
    public ?string $referenceReceiptId;
    /**
     * Príznak, ktorý bližšie špecifikuje „dôvod“ priradenia dane s hodnotou 0, 
     * ak bola položke priradená.
     * Platná hodnota dôvodu priradenia nulovej dane alebo <c>null</c>.
     * Hodnota môže byť uvedená iba pre položky s nulovou sadzbou dane.
     * @example Artwork
     */
    public ?string $taxFreeReason;
    /**
     * Číslo jednoúčelového poukazu pri jeho výmene za tovar alebo poskytnutú službu.
     * Textový reťazec s dĺžkou 1 až 50 v prípade, že typ položky je Voucher,
     * <c>null</c> v opačnom prípade.
     * @example 201801001
     */
    public ?string $voucherNumber;
    /**
     * Predávajúci, v ktorého mene bol predaný tovar alebo poskytnutá služba
     * Predávajúci alebo <c>null</c>, ak nebol uvedený
     */
    public ?Models\SellerDto $seller;
    /**
     * Nepovinný dodatočný popis položky dokladu, vyobrazený na doklade.
     */
    public ?string $description;

    public function __construct(
        string $type = ReceiptItemType::POSITIVE,
        string $name = "",
        float $unitPrice = 0,
        float $vatRate = 0,
        ?Models\QuantityDto $quantity = null,
        float $price = 0,
        ?string $description = null,
        ?Models\SellerDto $seller = null,
        ?string $taxFreeReason = null,
        ?string $voucherNumber = null,
        ?string $referenceReceiptId = null
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $this->vatRate = $vatRate;
        $this->quantity = $quantity ?? new Models\QuantityDto();
        $this->price = $price;
        $this->description = $description;
        $this->seller = $seller;
        $this->taxFreeReason = $taxFreeReason;
        $this->voucherNumber = $voucherNumber;
        $this->referenceReceiptId = $referenceReceiptId;
    }
}

?>