# Aplikacja REST API 
## Opis Aplikacji

Aplikacja "Biblioteczna" jest prostym REST API stworzonym w oparciu o framework Symfony, które umożliwia zarządzanie książkami. API pozwala na wykonywanie różnych operacji na książkach, takich jak dodawanie, aktualizacja, usuwanie, wypożyczanie, zwracanie i rezerwacja.

## Endpointy REST API

Aplikacja udostępnia następujące endpointy REST API:

1. `GET /books` - Pobieranie listy wszystkich książek.
2. `GET /books/{id}` - Pobieranie informacji o książce na podstawie jej identyfikatora.
3. `POST /books` - Dodawanie nowej książki.
4. `PUT /books/{id}` - Aktualizacja informacji o książce na podstawie jej identyfikatora.
5. `DELETE /books/{id}` - Usuwanie książki na podstawie jej identyfikatora.
6. `POST /books/{id}/borrow` - Wypożyczanie książki na podstawie jej identyfikatora. Książka nie jest dostępna do czasu jej zwrotu.
7. `POST /books/{id}/return` - Zwracanie wcześniej wypożyczonej książki na podstawie jej identyfikatora. Książka staje się dostępna.
8. `POST /books/{id}/reserve` - Rezerwowanie książki na podstawie jej identyfikatora na określony czas. Książka nie jest dostępna przez ten czas.

## Implementacja

Aplikacja REST API została napisana w oparciu o framework Symfony, wykorzystując PHP 8. Dokumentacja OpenAPI dostępna po uruchomieniu aplikacji pod enpointem /api/doc.
