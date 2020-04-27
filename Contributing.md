# Contribuer à ToDo List` 

En tant que contributeur, voici les lignes directrices que nous aimerions que vous suiviez :

* [Question ou Problème](#question-ou-problème)
* [Issues et Bugs](#issues-et-bugs)
* [Demande de fonctionnalité](#demande-de-fonctionnalité)
* [Règle de Codage](#règle-de-codage)

## Question ou Problème

N'ouvrez pas d'Issue pour des questions d'assistance générale car nous voulons conserver les Issues GitHub pour les rapports de bogues et les demandes de fonctionnalités.

Contactez l'assistance de ToDo & Co.

## Issues et Bugs

Si vous trouvez un bug dans le code source, vous pouvez nous aider en soumettant une [Issue](https://github.com/zohac/ToDoList/issues) à notre dépôt GitHub. Mieux encore, vous pouvez soumettre une [Pull Request](https://github.com/zohac/ToDoList/pulls) avec un correctif.

## Demande de fonctionnalité

Vous pouvez demander une nouvelle fonctionnalité en soumettant une [Issue](https://github.com/imaneis/BileMoOC/issues) à notre dépôt GitHub. Si vous souhaitez implémenter une nouvelle fonctionnalité, veuillez d'abord soumettre une [Issue](https://github.com/imaneis/BileMoOC/issues) avec une proposition pour votre travail, pour être sûr que nous pouvons l'utiliser. S'il vous plaît, réfléchissez à quel genre de changement il s'agit :

* Dans le cas d'une fonctionnalitée majeur, ouvrez d'abord une [Issue](https://github.com/imaneis/BileMoOC/issues) et décrivez votre proposition afin qu'elle puisse être discutée. Cela nous permettra également de mieux coordonner nos efforts, d'éviter le dédoublement du travail et de vous aider à concevoir les changements pour qu'ils soient acceptés avec succès dans le projet.
* Les petites fonctions peuvent être soumises directement par une [Pull Request](https://github.com/imaneis/BileMoOC/pulls). En cas de doute soumettez une [Issue](https://github.com/imaneis/BileMoOC/issues).

### Soumettre une Issue

Avant de soumettre une Issue, veuillez effectuer une recherche dans l'outil de suivi des Issues, peut-être qu'il existe déjà une Issue pour votre problème et que la discussion pourrait vous informer des solutions disponibles.

Nous voulons corriger tous les problèmes dès que possible, mais avant de corriger un bogue, nous devons le reproduire et le confirmer. Afin de reproduire les bogues, nous vous demanderons systématiquement de fournir les informations suivantes :

* Version de ToDo List utilisée
* Bibliothèques tierces et leurs versions
* Et le plus important - un cas d'utilisation qui échoue

### Soumettre une Pull Request

Avant de soumettre votre Pull Request (PR), tenez compte des lignes directrices suivantes :

1. Recherchez sur GitHub pour une PR ouverte ou fermée qui se rapporte à votre soumission. Vous ne voulez pas dupliquer l'effort.

2. Assurez-vous qu'une Issue décrit le problème que vous corrigez ou documente la conception de la fonctionnalité que vous souhaitez ajouter. En discutant de la conception à l'avance, nous nous assurons d'être prêts à accepter votre travail.

3. Fork du repositorie ToDo List.

4. Faites vos changements dans une nouvelle branche git :

   ```bash
   git checkout -b hotfix/My-Issue master
   ```

5. Créez votre patch, y compris les tests.

6. Suivez nos [règles de codage](#règle-de-codage).

7. Exécutez la suite de tests complète, et assurez-vous que tous les tests réussissent.

8. "Commit" vos modifications à l'aide d'un message de validation descriptif qui respecte les conventions de notre [guide des messages de Commit](#guide-des-messages-de-commit).

   ```bash
   git commit -a
   ```

9. Poussez votre branche vers GitHub :

   ```bash
   git push origin fix/My-Issue
   ```

Si nous suggérons des changements, alors :

* Effectuez les mises à jour nécessaires.

* Ré-exécutez les suites de tests pour vous assurer que les tests sont toujours valide.

* Rebasez votre branche et forcez le push vers votre dépôt GitHub (cela mettra à jour votre Pull Request) :

   ```bash
   git rebase master -i
   git push -f
   ```

C'est bon! Merci pour votre contribution!

#### Après la fusion de votre Pull Request

Vous pouvez supprimer votre branche en toute sécurité :

* Supprimez la branche distante sur GitHub :

   ```bash
   git push origin --delete feature/My-Issue
   ```

* Basculer la branche maître :

   ```bash
   git checkout master -f
   ```

* Supprimer la branche locale :

   ```bash
   git branch -D feature/My-Issue
   ```

* Mettez à jour votre branch master/develop avec la dernière version :

   ```bash
   git pull --ff upstream master
   ```

## Règle de Codage

Pour assurer la cohérence du code source, gardez ces règles à l'esprit lorsque vous travaillez :

* Toutes les fonctionnalités ou corrections de bogues doivent être testées par un ou plusieurs tests (tests unitaires et/ou fonctionnels).
* Nous respectons le guide de style [PSR1](https://www.php-fig.org/psr/psr-1), [PSR2](https://www.php-fig.org/psr/psr-2/) et [Symfony](https://symfony.com/doc/current/contributing/code/standards.html). Veuillez utiliser l'outil [php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) pour vérifier votre code.

Exemple de commande:

```bash
php-cs-fixer fix src --rules=@Symfony,@PSR1,@PSR2
```