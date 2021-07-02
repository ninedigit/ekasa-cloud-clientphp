<?php

namespace NineDigit\eKasa\Cloud\ApiClient\Models\Registrations\Receipts;

/**
 * Objekt nastavení tlače papierového dokladu.
 */
final class PosReceiptPrinterOptions extends ReceiptPrinterOptions {
  /**
   * Nepovinný príznak otvorenia peňažnej zásuvky. Ak je uvedený (nie <c>null</c>), 
   * aplikácia uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
   */
  public ?bool $openDrawer;
  /**
   * Nepovinný príznak tlače grafického loga. Ak je uvedený (nie <c>null</c>), 
   * aplikácia uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
   */
  public ?bool $printLogo;
  /**
   * Nepovinná adresa tlače grafického loga. Ak je uvedená (nie <c>null</c>), 
   * aplikácia uprednostní túto hodnotu pred hodnotou v nastaveniach aplikácie.
   * Hodnota predstavuje číslo v rozsahu 0-255.
   */
  public ?int $logoMemoryAddress;
}

?>