# mediadb

### Vorinstallationen

* Virtualbox - https://www.virtualbox.org/
* Vagrant - https://www.vagrantup.com/
* Node - https://nodejs.org/en/
* Composer - https://getcomposer.org/doc/00-intro.md


### Installation

Repository clonen

```
git clone https://github.com/annazeller/mediadb.git
```

SSH Key generieren

1. Verzeichnis .ssh im Benutzerordner erstellen
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

Homestead.yaml anpassen:

```
folders:
    map: path/to/my/projectdirectory
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



