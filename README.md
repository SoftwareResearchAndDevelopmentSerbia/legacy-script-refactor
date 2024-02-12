Test zadatak za Backend developera
Zadati kod potrebno je refaktorisati bez korišćenja gotovog framework rešenja. Refaktorizacija treba da
iskoristi pattern-e i S.O.L.I.D principe.

Dodatni zahtevi:

Treba proširiti Validator sistem tako da podržava i sledeće provere:

○ Da li email adresa već postoji u sistemu?

○ Da li MaxMind, eksterni sistem za detektovanje prevaranata, vraće pozitivan ili negativan
rezultat za email i IP adresu korisnika? Pozitivan rezultat provere znači da registracija nije
moguća. (Napomena: Ne treba realizovati stvarnu konekciju sa MaxMind-om već samo
simulirati)

Treba implementirati mogućnost prosleđivanja SQL izraza pri select, insert i update upitima. Primeri
su:

○ INSERT upit treba da može da postavi vrednost polja posted na NOW()

○ WHERE deo upita treba da može da ima uslov posted > NOW() - INTERVAL 10 DAY