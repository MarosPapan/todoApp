+ Čo ste sa počas práce naučili
Celý priebeh vývoja tejto aplikácie nebol pre mňa cudzí pretože MVC architektúru už poznám z iných projektov. Najmä z python framework Django kde som si vytvaral vlastne projekty a aj z brigady Php Yii2 framework a projektov zo školy node.js plus react. Nové bolo pre mňa využívať tailwind no to bolo asi to najjednoduchšie na tomto projekte pretože to je vizualizácia frontend. Prekvapilo ma že sa schemy robia priamo v migraciach v django som robil tabuľkovú schému priamo v Models a teda on to na pozadi prepisal do migracii. Keď som chcel aby sa zmena zaznamenala v models tak som musel spustit migracie. Čož je podobne aj tu. 

Taktiež uplné nové bolo pre mňa factories a vytvarenie seedera na testovacie data. Ale není to zložitý koncept v factory nastaviš ako a čo chceš aby sa generovalo. A v seeder nastavíš koľko sa toho má vytvoriť. A veľmi užitočné pri zmenách databázy.

+ Aké problémy ste riešili a ako ste ich vyriešili
Najväčši problém asi čo som riešil bol hneď na začiatku s xampp, kde som si chcel nastaviť aby xampp využival PHP 8.5.1 no rychlo som zistil, že som urobil chybu a vratil som to na 8.2.*. Teda preinštaloval som celý xampp aby bol v zakladnom nastavení. A plus problemy pri vývoji ako keď sa zabudne na import a vyhadzuje ti chybu. 
A pri označení tasku ako dokončenie sa mi stale menil datum dokončenia. V Scheme som mal nastavene timestamps na due_time a vždy keď sa odoslal request tak mi ho zmenilo na aktualny dátum. Potom som to zmenil na datetime->nullable(), tak dovolilo aby ked sa odoslal request a ak nebola zadana hodnota na due_time tak zostala rovnako a neprepisovalo mi to na aktualny cas.

+ Čo by ste urobili inak, keby ste mali viac času
Autentifikáciu by som urobil lepšie. Možno by som pridal aj paggination pozeral som na to nevypadalo to zložito a keď som to skusal aj to islo len sa mi tam dizajn nevidel tak som to dal preč. 
Plus vytvoril by som Admin usera, ktory by vedel spravovat ostatných userov a menit aj ostatne tasky on by mal celkový pristup v appke. A nejaký admin page pre admina. A nejaky lepsi dizajn neni najhorsi ale da sa aj lepsie. 
