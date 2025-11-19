# Database Instructies voor Aether Digitale Vondsten

## Stap 1: Maak de database aan via PHPMyAdmin (https://pma.sd-lab.nl/)

Database naam: `jouw_studentnummer_aether`
Bijvoorbeeld: `s1234567_aether`

## Stap 2: Maak de tabel `items` aan

Voer deze SQL-query uit in PHPMyAdmin:

```sql
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL,
  `beschrijving` text NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `jaar_vondst` int(4) NOT NULL,
  `datum_toegevoegd` date NOT NULL,
  `status` enum('te restaureren','gerestaureerd','beschadigd','compleet') NOT NULL,
  `locatie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Stap 3: Maak de tabel `users` aan voor inlogsysteem

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Stap 4: Voeg een testgebruiker toe

```sql
INSERT INTO `users` (`username`, `password`, `email`) 
VALUES ('admin', SHA1('admin123'), 'admin@aether.nl');
```

## Stap 5: Voeg testdata toe aan items

```sql
INSERT INTO `items` (`titel`, `beschrijving`, `categorie`, `jaar_vondst`, `datum_toegevoegd`, `status`, `locatie`) VALUES
('Diskette DOS 3.3', 'Originele DOS installatie diskette uit de jaren 80', 'Software', 1985, '2025-11-19', 'gerestaureerd', 'Archief A-12'),
('Commodore 64 Game', 'Spelcassette van klassieker uit 1984', 'Gaming', 1984, '2025-11-18', 'te restaureren', 'Kluis B-03'),
('Oude Website HTML', 'Eerste versie van een bedrijfswebsite uit 1998', 'Web', 1998, '2025-11-17', 'compleet', 'Server S-05'),
('Windows 95 CD-ROM', 'Installatie CD met originele licentie', 'Software', 1995, '2025-11-16', 'gerestaureerd', 'Archief A-08'),
('Nokia 3310 Firmware', 'Originele firmware van iconische telefoon', 'Mobile', 2000, '2025-11-15', 'compleet', 'Digitaal D-01');
```

## Database Gegevens

- **Hostnaam**: Wordt opgegeven door SD-Lab
- **Database naam**: Zie hierboven
- **Gebruikersnaam**: Jouw SD-Lab MySQL gebruikersnaam
- **Wachtwoord**: Jouw SD-Lab MySQL wachtwoord

Vul deze gegevens in bij `config.php`
