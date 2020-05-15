# BONNES PRATIQUES

## Les branches
- branch master : que pour release → finale
- branch develop : branch commune des développements en cours. Ne jamais push directement sur develop.

## Comment commencer mon dev
- Se positionner sur develop `git checkout develop`
- Se mettre à jour `git pull`
- Créer ma nouvelle branche pour mon développement `git checkout -b feature/maFeature` (bien respecter la convention de nommage, une feature commence toujorus pas "feature/" puis le nom de la feature en camelCase) 
- Faire un `git push` pour envoyer ma branche sur le serveur github

## J'ai fini mon dev
- Je vérifie que j'ai bien push toutes mes modifications sur ma branche
- Sur GitHub, ouvrir une pull request
- Sélectionner en `base` develop et en `compare` feature/maFeature
- Demander à un autre membre de se rendre sur la pull request pour faire une revue de code et valider la feature
- Une fois fait, on peut cliquer sur "Merge" depuis la pull request
