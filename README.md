# Pown is Page's ORM

Pown (p-oh-n)

A smartly designed PDO-based PHP ORM with database seeding capabilities written to work in conjunction with Page http://github.com/h3rb/page and Papi http://github.com/h3rb/papi to define data ownership in a relational database using PDO.

Pown is an Object-Relational Mapper (O/R) combined with Imaginary Object-Role Modeling as the programmer interface.

_Example Usage_

```php
$orm=new Pown('/offline/data_model.pown');
```

Contents of ```data_model.pown```:

```hdata
comment {
 name "Comment"
 description "Your comment."
 notes "A comment ownable by a user."
 creatable
 ownable
 property { type int placeholder { "placeholder" } }
}
```
