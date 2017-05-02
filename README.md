# Pown is Page's ORM

Pown (p-oh-n)

A simple but powerful PDO-based PHP ORM with database seeding capabilities written to work in conjunction with Page http://github.com/h3rb/page and Papi http://github.com/h3rb/papi to define data ownership in a relational database using PDO.

Pown is an Object-Relational Mapper (O/R) combined with Imaginary Object-Role Modeling as the programmer interface.

_Example Usage_

```php
$orm=new Pown('/offline/data_model.pown');
```

Contents of ```data_model.pown```:

```C++ (not really, its the HData format from Page)
comment {
 name "Comment"
 description "Your comment."
 notes "A comment ownable by a user."
 creatable
 ownable
 personal
 property { type bool placeholder "placeholder" } }
 property { type int placeholder "placeholder" } }
 property { type unsigned placeholder { "placeholder" } }
 property { type datetime placeholder { "placeholder" } }
 property { type string placeholder { "placeholder" } }
 property { type text placeholder { "placeholder" } }
 property { type json placeholder { "placeholder" } }
}

```
