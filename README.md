# Pown is Page's ORM

Pown (p-oh-n)

A simple but powerful PDO-based PHP ORM with database seeding capabilities written to work in conjunction with Page http://github.com/h3rb/page and Papi http://github.com/h3rb/papi to define data ownership in a relational database using PDO.


_Pown_ is an Object-Relational Mapper (O/R) combined with Imaginary Object-Role Modeling as the programmer interface.

The ORM will implement data structures and relationships only.  In your PHP models, you can react to data relationships, or used prepackaged features, or package your own features in reaction to the data structure.  The ORM will never give you data you cannot access, as long as the relationships are established correctly in your implementation.

## Syntax

HData is this special format that lets me define basic data structures using a simple syntax.  The general syntax is:

```
{} '' "" [] () 
``` 
The above symbols are all essentially the same.  They _group_ things.  It simply allows you to have spaces in the names of things.
Spaces, commas, new lines (carriage returns). Linefeeds are ignored and filtered.

```
_"string"
```

The above statement (underscore before a string) attempts to load the filepath described as "string" as a source file relative to the Pown script folder.  The required file type is relative to its use.  It may be a URL instead of a file, though this has different ramifications.  The URL can be application-self-referencing (the source is an equivalent ajax endpoint and expects a specialized response) or an external site.  Generally you will want to use local files, but there may be special cases or other uses when URLs are used.  It follows the rules of PHP's file_get_contents in the configuration.

```
$"string"
```

The $ symbol permits you to reference _templated markup_ from a text document. (WIP)


```
<tag or key value> {param}...
```

At it's core, HData is a key-value sequence defining something as simply a "data molecule", though it can react to keyword content before it pairs the value content.  In some cases, a single keyword or a series of single keywords can invoke alterations to the way a definition is interpreted, acting as qualifiers.

See the "microlanguage breakdown" section for specific keywords and their uses.


## Demo

Pown comes with a sample website that demonstrates how it can be paired with a javascript front-end.

_Example Usage_

```php
$orm=new Pown('/offline/data_model.pown');
```

Contents of ```data_model.pown```:

```C++ (not really, its the HData format from Page)
table comment {
 name "Comment"
 description "A comment."
 notes "A comment ownable by a user."
 ownable
 creatable
 timestamp
 property {text content}
 property {parent post}
 collection {reply anyone}
 css {comments.css}
}

table reply {
 name "Reply"
 description "A reply to a comment."
 notes "A reply to a comment."
}

table post {
 name "Comment"
 description "A comment."
 notes "A comment ownable by a user."
 collection {comment anyone}
 css {posts.css}
 property {bool noReply}
 property {parent topic}
}

table topic {
 name "Topic"
 description "A topic"
 notes "A topic created by a special user."
 deletable {owner}
 collection { post }
 property {enum:category Category}
}

enum toggle { hi, mid, low }
enum dial { 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 }
enum category {_"http://cdn/categories.json"}   # use of _ denotes external source local file or url
```

Microlanguage Breakdown (HData)

Table Object Definitions:
```
table <name_in_database> {
 command
 .
 .
 command {param}
 .
 .
}
```

All tables have some default fields assigned to them.  One is "ID" for example.  Here is the full list in SQL.

| SQL | Purpose |
| ID UNSIGNED INT NOT NULL PRIMARY KEY AUTO_INCREMENT | The unique identifier, obscured to the client with a bidirectional hash. |
| ACL TEXT | Contains any specialty ACL tags |
| Creator UNSIGNED INT NOT NULL | Reference to the object originator |
| Created UNSIGNED INT NOT NULL | Unix epoch time |

Defines a table and executes a series of _commands_ in its definition that establish various aspects of the table including:
1. Properties (Fields in database)
2. Arbitrary command words that invoke special access priviledges, or establish pre-configured specialty fields.
3. Relationships between a table and other tables.

Keywords and qualifiers

| Keyword | Parameters | Purpose |
| `name` | `{textual content}` | Sets the name of something.  Purely descriptive. |
| `description` | `{textual content}` | Sets a description of something for documenting its purpose. |
| `notes` | `{note content}` | Any additional notes or thoughts on this item. |
| `creatable` | {user admin} | Indicates what ACL roles can create this. |
| `ownable` | {creator|anyone} | Indicates who can claim ownership of something and therefore write to it. |
| `collection` | {type creator|group|anyone} | Defines a collection from a related table as children. |
| `property` | {type name qualifiers} | Defines a strictly typed property like a string or a complex object in JSON. See qualifiers table below |
| `property` | {parent table qualifiers} | Defines a table parent reference.  See below |
| `requires` | {ACL} | Requires an ACL to view. |
| `personal` | | Requires you to be the owner to view. |
| `public` | | Can be viewed by anyone on the web, even if the user is not logged in. |
| `private` | | Cannot be viewed by anyone who is logged in except administrators. |
| `lockable` | | Can be locked and therefore unmodifiable. |

Structural types
| Name | Description |
| int | Storeable as an int(11) |
| decimal | Storeable as a decimal(10,8) |
| money | Storeable specifically as monetary units, which includes a standard currency type but will be converted by the front-end to localize. |
| datetime | A date and time string in UTC |
| timestamp | unix epoch time (milliseconds) |
| string | A short one-liner, a TEXT |
| text | Multi-line text stored as a LONGTEXT |
| enum:name | A special set of integers that translate into states |
| flags:name | A special set of toggles stored in a single integer using bit vectoring |
| json | JSON stored in a LONGTEXT |




Note on ACL and roles: ACL are definable using the role definition type, but there are several roles which are special and programmed into Pown.

Default Role Object Definitions:

| Name | Description |
| User | All users have this role. |
| Admin | Only special users have this role.  This is the highest level of access. |
| Anyone | This role indicates any user. |
| Creator | This role indicates that the user is the "author", "maker" or "invoker" of the thing (table row). |
| Owner | This role indicates the "author" owns, by way of inheritance, any parent of the object. |
| Group | This role indicates the user shares a common group with the creator/author. |


