<?php

namespace Crearco\Rcf\I18n;

class Translator {
	private const SUPPORTED_LOCALES = [ 'en', 'de', 'pt', 'fr', 'it' ];

	private const TRANSLATIONS = [
		'Información de entrega' => [
			'en' => 'Delivery information',
			'de' => 'Lieferinformationen',
			'pt' => 'Informacoes de entrega',
			'fr' => 'Informations de livraison',
			'it' => 'Informazioni di consegna',
		],
		'Nombre empresa' => [
			'en' => 'Company name',
			'de' => 'Firmenname',
			'pt' => 'Nome da empresa',
			'fr' => 'Nom de l\'entreprise',
			'it' => 'Nome azienda',
		],
		'Nombre empresa *' => [
			'en' => 'Company name *',
			'de' => 'Firmenname *',
			'pt' => 'Nome da empresa *',
			'fr' => 'Nom de l\'entreprise *',
			'it' => 'Nome azienda *',
		],
		'CIF' => [
			'en' => 'Tax ID',
			'de' => 'Steuer-ID',
			'pt' => 'NIF',
			'fr' => 'Numero fiscal',
			'it' => 'Partita IVA',
		],
		'CIF *' => [
			'en' => 'Tax ID *',
			'de' => 'Steuer-ID *',
			'pt' => 'NIF *',
			'fr' => 'Numero fiscal *',
			'it' => 'Partita IVA *',
		],
		'Teléfono de contacto' => [
			'en' => 'Contact phone',
			'de' => 'Kontakttelefon',
			'pt' => 'Telefone de contato',
			'fr' => 'Telephone de contact',
			'it' => 'Telefono di contatto',
		],
		'Teléfono de Contacto *' => [
			'en' => 'Contact phone *',
			'de' => 'Kontakttelefon *',
			'pt' => 'Telefone de contato *',
			'fr' => 'Telephone de contact *',
			'it' => 'Telefono di contatto *',
		],
		'Correo electrónico' => [
			'en' => 'Email address',
			'de' => 'E-Mail-Adresse',
			'pt' => 'Email',
			'fr' => 'Email',
			'it' => 'Email',
		],
		'Correo electrónico *' => [
			'en' => 'Email address *',
			'de' => 'E-Mail-Adresse *',
			'pt' => 'Email *',
			'fr' => 'Email *',
			'it' => 'Email *',
		],
		'Dirección de envío' => [
			'en' => 'Shipping address',
			'de' => 'Lieferadresse',
			'pt' => 'Endereco de envio',
			'fr' => 'Adresse de livraison',
			'it' => 'Indirizzo di spedizione',
		],
		'Dirección de facturación' => [
			'en' => 'Billing address',
			'de' => 'Rechnungsadresse',
			'pt' => 'Endereco de faturamento',
			'fr' => 'Adresse de facturation',
			'it' => 'Indirizzo di fatturazione',
		],
		'Tu Configuración' => [
			'en' => 'Your configuration',
			'de' => 'Ihre Konfiguration',
			'pt' => 'Sua configuracao',
			'fr' => 'Votre configuration',
			'it' => 'La tua configurazione',
		],
		'No has seleccionado ningún pack todavía.' => [
			'en' => 'You have not selected any pack yet.',
			'de' => 'Sie haben noch kein Paket ausgewahlt.',
			'pt' => 'Ainda nao selecionou nenhum pack.',
			'fr' => 'Vous n\'avez encore selectionne aucun pack.',
			'it' => 'Non hai ancora selezionato alcun pacchetto.',
		],
		'Total:' => [
			'en' => 'Total:',
			'de' => 'Gesamt:',
			'pt' => 'Total:',
			'fr' => 'Total :',
			'it' => 'Totale:',
		],
		'Impuestos a determinar' => [
			'en' => 'Taxes to be determined',
			'de' => 'Steuern werden bestimmt',
			'pt' => 'Impostos a determinar',
			'fr' => 'Taxes a determiner',
			'it' => 'Tasse da determinare',
		],
		'Solicitar presupuesto' => [
			'en' => 'Request quote',
			'de' => 'Angebot anfordern',
			'pt' => 'Solicitar orcamento',
			'fr' => 'Demander un devis',
			'it' => 'Richiedi preventivo',
		],
		'Ver imagen ampliada de %s' => [
			'en' => 'View enlarged image of %s',
			'de' => 'Vergrossertes Bild von %s anzeigen',
			'pt' => 'Ver imagem ampliada de %s',
			'fr' => 'Voir l\'image agrandie de %s',
			'it' => 'Visualizza immagine ingrandita di %s',
		],
		'Restar unidad de %s' => [
			'en' => 'Remove one unit of %s',
			'de' => 'Eine Einheit von %s entfernen',
			'pt' => 'Remover uma unidade de %s',
			'fr' => 'Retirer une unite de %s',
			'it' => 'Rimuovi un\'unita di %s',
		],
		'Añadir unidad de %s' => [
			'en' => 'Add one unit of %s',
			'de' => 'Eine Einheit von %s hinzufugen',
			'pt' => 'Adicionar uma unidade de %s',
			'fr' => 'Ajouter une unite de %s',
			'it' => 'Aggiungi un\'unita di %s',
		],
		'Vista ampliada de producto' => [
			'en' => 'Enlarged product view',
			'de' => 'Vergrosserte Produktansicht',
			'pt' => 'Visualizacao ampliada do produto',
			'fr' => 'Vue agrandie du produit',
			'it' => 'Vista ingrandita del prodotto',
		],
		'Cerrar vista ampliada' => [
			'en' => 'Close enlarged view',
			'de' => 'Vergrosserte Ansicht schliessen',
			'pt' => 'Fechar visualizacao ampliada',
			'fr' => 'Fermer la vue agrandie',
			'it' => 'Chiudi vista ingrandita',
		],
		'Sin categoría' => [
			'en' => 'Uncategorized',
			'de' => 'Ohne Kategorie',
			'pt' => 'Sem categoria',
			'fr' => 'Sans categorie',
			'it' => 'Senza categoria',
		],
		'Error al enviar el pedido. Por favor, intentalo de nuevo o pongase en contacto con nosotros si el problema persiste.' => [
			'en' => 'Error sending the order. Please try again or contact us if the problem persists.',
			'de' => 'Fehler beim Senden der Bestellung. Bitte versuchen Sie es erneut oder kontaktieren Sie uns, wenn das Problem weiterhin besteht.',
			'pt' => 'Erro ao enviar o pedido. Tente novamente ou entre em contato conosco se o problema persistir.',
			'fr' => 'Erreur lors de l\'envoi de la commande. Veuillez reessayer ou nous contacter si le probleme persiste.',
			'it' => 'Errore durante l\'invio dell\'ordine. Riprova o contattaci se il problema persiste.',
		],
		'Configuracion AJAX no disponible.' => [
			'en' => 'AJAX configuration not available.',
			'de' => 'AJAX-Konfiguration nicht verfugbar.',
			'pt' => 'Configuracao AJAX nao disponivel.',
			'fr' => 'Configuration AJAX non disponible.',
			'it' => 'Configurazione AJAX non disponibile.',
		],
		'Debes seleccionar al menos un producto.' => [
			'en' => 'You must select at least one product.',
			'de' => 'Sie mussen mindestens ein Produkt auswahlen.',
			'pt' => 'Voce deve selecionar pelo menos um produto.',
			'fr' => 'Vous devez selectionner au moins un produit.',
			'it' => 'Devi selezionare almeno un prodotto.',
		],
		'Tu pedido se ha enviado correctamente! En breve nos pondremos en contacto contigo para confirmar los detalles y el pago. ¡Gracias por confiar en nosotros!' => [
			'en' => 'Your order has been sent successfully! We will contact you shortly to confirm details and payment. Thank you for trusting us!',
			'de' => 'Ihre Bestellung wurde erfolgreich gesendet! Wir werden Sie in Kurze kontaktieren, um Details und Zahlung zu bestatigen. Vielen Dank fur Ihr Vertrauen!',
			'pt' => 'Seu pedido foi enviado com sucesso! Em breve entraremos em contato para confirmar os detalhes e o pagamento. Obrigado por confiar em nos!',
			'fr' => 'Votre commande a ete envoyee avec succes ! Nous vous contacterons bientot pour confirmer les details et le paiement. Merci de votre confiance !',
			'it' => 'Il tuo ordine e stato inviato correttamente! Ti contatteremo a breve per confermare i dettagli e il pagamento. Grazie per la fiducia!',
		],
		'Nuevo pedido para residencia' => [
			'en' => 'New residence order',
			'de' => 'Neue Bestellung fur Residenz',
			'pt' => 'Novo pedido para residencia',
			'fr' => 'Nouvelle commande pour residence',
			'it' => 'Nuovo ordine per residenza',
		],
		'Datos de la empresa' => [
			'en' => 'Company details',
			'de' => 'Unternehmensdaten',
			'pt' => 'Dados da empresa',
			'fr' => 'Donnees de l\'entreprise',
			'it' => 'Dati aziendali',
		],
		'Email:' => [
			'en' => 'Email:',
			'de' => 'E-Mail:',
			'pt' => 'Email:',
			'fr' => 'Email :',
			'it' => 'Email:',
		],
		'Teléfono:' => [
			'en' => 'Phone:',
			'de' => 'Telefon:',
			'pt' => 'Telefone:',
			'fr' => 'Telephone :',
			'it' => 'Telefono:',
		],
		'Direcciones' => [
			'en' => 'Addresses',
			'de' => 'Adressen',
			'pt' => 'Enderecos',
			'fr' => 'Adresses',
			'it' => 'Indirizzi',
		],
		'Dirección de envío:' => [
			'en' => 'Shipping address:',
			'de' => 'Lieferadresse:',
			'pt' => 'Endereco de envio:',
			'fr' => 'Adresse de livraison :',
			'it' => 'Indirizzo di spedizione:',
		],
		'Dirección de facturación:' => [
			'en' => 'Billing address:',
			'de' => 'Rechnungsadresse:',
			'pt' => 'Endereco de faturamento:',
			'fr' => 'Adresse de facturation :',
			'it' => 'Indirizzo di fatturazione:',
		],
		'Productos' => [
			'en' => 'Products',
			'de' => 'Produkte',
			'pt' => 'Produtos',
			'fr' => 'Produits',
			'it' => 'Prodotti',
		],
		'Producto' => [
			'en' => 'Product',
			'de' => 'Produkt',
			'pt' => 'Produto',
			'fr' => 'Produit',
			'it' => 'Prodotto',
		],
		'Referencia' => [
			'en' => 'Reference',
			'de' => 'Referenz',
			'pt' => 'Referencia',
			'fr' => 'Reference',
			'it' => 'Riferimento',
		],
		'Cantidad' => [
			'en' => 'Quantity',
			'de' => 'Menge',
			'pt' => 'Quantidade',
			'fr' => 'Quantite',
			'it' => 'Quantita',
		],
		'Precio' => [
			'en' => 'Price',
			'de' => 'Preis',
			'pt' => 'Preco',
			'fr' => 'Prix',
			'it' => 'Prezzo',
		],
		'Total del pedido: %s' => [
			'en' => 'Order total: %s',
			'de' => 'Bestellsumme: %s',
			'pt' => 'Total do pedido: %s',
			'fr' => 'Total de la commande : %s',
			'it' => 'Totale ordine: %s',
		],
		'Nonce invalido.' => [
			'en' => 'Invalid nonce.',
			'de' => 'Ungueltiger Nonce.',
			'pt' => 'Nonce invalido.',
			'fr' => 'Nonce invalide.',
			'it' => 'Nonce non valido.',
		],
		'Nuevo pedido de residencia' => [
			'en' => 'New residence order request',
			'de' => 'Neue Bestellanfrage fur Residenz',
			'pt' => 'Novo pedido de residencia',
			'fr' => 'Nouvelle demande de commande pour residence',
			'it' => 'Nuova richiesta ordine per residenza',
		],
		'Faltan datos obligatorios del cliente.' => [
			'en' => 'Required customer data is missing.',
			'de' => 'Pflichtangaben des Kunden fehlen.',
			'pt' => 'Faltam dados obrigatorios do cliente.',
			'fr' => 'Il manque des donnees client obligatoires.',
			'it' => 'Mancano dati obbligatori del cliente.',
		],
		'No hay productos seleccionados.' => [
			'en' => 'No products selected.',
			'de' => 'Keine Produkte ausgewahlt.',
			'pt' => 'Nao ha produtos selecionados.',
			'fr' => 'Aucun produit selectionne.',
			'it' => 'Nessun prodotto selezionato.',
		],
		'No se pudo enviar el email.' => [
			'en' => 'The email could not be sent.',
			'de' => 'Die E-Mail konnte nicht gesendet werden.',
			'pt' => 'Nao foi possivel enviar o email.',
			'fr' => 'Impossible d\'envoyer l\'email.',
			'it' => 'Impossibile inviare l\'email.',
		],
		'Error interno al procesar el pedido.' => [
			'en' => 'Internal error while processing the order.',
			'de' => 'Interner Fehler bei der Verarbeitung der Bestellung.',
			'pt' => 'Erro interno ao processar o pedido.',
			'fr' => 'Erreur interne lors du traitement de la commande.',
			'it' => 'Errore interno durante l\'elaborazione dell\'ordine.',
		],
		'Productos Formulario' => [
			'en' => 'Form Products',
			'de' => 'Formularprodukte',
			'pt' => 'Produtos do formulario',
			'fr' => 'Produits du formulaire',
			'it' => 'Prodotti modulo',
		],
		'Producto Formulario' => [
			'en' => 'Form Product',
			'de' => 'Formularprodukt',
			'pt' => 'Produto do formulario',
			'fr' => 'Produit du formulaire',
			'it' => 'Prodotto modulo',
		],
		'Añadir producto formulario' => [
			'en' => 'Add form product',
			'de' => 'Formularprodukt hinzufugen',
			'pt' => 'Adicionar produto do formulario',
			'fr' => 'Ajouter un produit du formulaire',
			'it' => 'Aggiungi prodotto modulo',
		],
		'Editar producto formulario' => [
			'en' => 'Edit form product',
			'de' => 'Formularprodukt bearbeiten',
			'pt' => 'Editar produto do formulario',
			'fr' => 'Modifier le produit du formulaire',
			'it' => 'Modifica prodotto modulo',
		],
		'Categorias de producto' => [
			'en' => 'Product categories',
			'de' => 'Produktkategorien',
			'pt' => 'Categorias de produto',
			'fr' => 'Categories de produits',
			'it' => 'Categorie prodotto',
		],
		'Categoria de producto' => [
			'en' => 'Product category',
			'de' => 'Produktkategorie',
			'pt' => 'Categoria de produto',
			'fr' => 'Categorie de produit',
			'it' => 'Categoria prodotto',
		],
		'Buscar categorias' => [
			'en' => 'Search categories',
			'de' => 'Kategorien suchen',
			'pt' => 'Buscar categorias',
			'fr' => 'Rechercher des categories',
			'it' => 'Cerca categorie',
		],
		'Todas las categorias' => [
			'en' => 'All categories',
			'de' => 'Alle Kategorien',
			'pt' => 'Todas as categorias',
			'fr' => 'Toutes les categories',
			'it' => 'Tutte le categorie',
		],
		'Editar categoria' => [
			'en' => 'Edit category',
			'de' => 'Kategorie bearbeiten',
			'pt' => 'Editar categoria',
			'fr' => 'Modifier la categorie',
			'it' => 'Modifica categoria',
		],
		'Actualizar categoria' => [
			'en' => 'Update category',
			'de' => 'Kategorie aktualisieren',
			'pt' => 'Atualizar categoria',
			'fr' => 'Mettre a jour la categorie',
			'it' => 'Aggiorna categoria',
		],
		'Anadir nueva categoria' => [
			'en' => 'Add new category',
			'de' => 'Neue Kategorie hinzufugen',
			'pt' => 'Adicionar nova categoria',
			'fr' => 'Ajouter une nouvelle categorie',
			'it' => 'Aggiungi nuova categoria',
		],
		'Nombre de la categoria' => [
			'en' => 'Category name',
			'de' => 'Kategoriename',
			'pt' => 'Nome da categoria',
			'fr' => 'Nom de la categorie',
			'it' => 'Nome della categoria',
		],
		'Categorias' => [
			'en' => 'Categories',
			'de' => 'Kategorien',
			'pt' => 'Categorias',
			'fr' => 'Categories',
			'it' => 'Categorie',
		],
	];

	public static function translate( string $text, array $args = [] ): string {
		$language = self::currentLanguage();
		$translated = self::TRANSLATIONS[ $text ][ $language ] ?? $text;

		if ( empty( $args ) ) {
			return $translated;
		}

		return vsprintf( $translated, $args );
	}

	private static function currentLanguage(): string {
		$locale = function_exists( 'determine_locale' ) ? determine_locale() : get_locale();
		$language = strtolower( substr( (string) $locale, 0, 2 ) );

		if ( in_array( $language, self::SUPPORTED_LOCALES, true ) ) {
			return $language;
		}

		return 'es';
	}
}
