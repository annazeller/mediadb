# mediadb

### Vorinstallationen

* Virtualbox - https://www.virtualbox.org/
* Vagrant - https://www.vagrantup.com/
* Node - https://nodejs.org/en/
* Composer - https://getcomposer.org/doc/00-intro.md

### Projekt installieren

Repository clonen:
```
git clone https://github.com/annazeller/mediadb.git
```

Laravel dependencies installieren:
```
composer install
```

.env Datei erstellen (In der Konsole):
```
cp .env.example .env
```

App Key generieren
```
php artisan key:generate
```

### Installation

SSH Key generieren

1. Verzeichnis .ssh im Benutzerordner erstellen (Code unten)
2. Ins verzeichnis wechseln
3. Key generieren
4. Im aktuellen Verzeichnis ohne passphrase speichern

```
 mkdir ~/.ssh
 cd ~/.ssh
 ssh-keygen.exe
```

Ins Projektverzeichnis navigieren und dependencies mit composer und npm installieren:

```
npm install
composer install
```

Homestead.yaml erstellen:

```
ip: 192.168.10.10
memory: 2048
cpus: 1
provider: virtualbox
authorize: ~/.ssh/id_rsa.pub
keys:
    - ~/.ssh/id_rsa
folders:
    -
        map: C:/Wamp/sites/mediadb #Hier eigenen Pfad zum Projekt eintragen
        to: /home/vagrant/code
sites:
    -
        map: homestead.test
        to: /home/vagrant/code/public
databases:
    - homestead
name: mediadb
hostname: mediadb
```

## Starten

```
cd path/to/my/project
vagrant up --provision
```

Bei Fehler 
```
"The VirtualBox VM was created with a user that doesn't match the current user running Vagrant. VirtualBox requires that the same userbe used to manage the VM that was created. Please re-run Vagrant withthat user. This is not a Vagrant issue.The UID used to create the VM was: 501 Your UID is: 0":
```
entweder creator_uid anpassen

```
nano .vagrant/machines/mediadb/virtualbox/creator_uid
```
oder .vagrant-Verzeichnis komplett löschen

```
rm -r .vagrant
vagrant up --provision
```

Wenn Vagrant hochgefahren ist:

```
vagrant ssh
cd code
php artisan migrate
```

Webapp öffnen
http://192.168.10.10



