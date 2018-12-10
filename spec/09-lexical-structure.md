# Lexical Structure

## Program

Typically, a [program](04-basic-concepts.md#program-structure) consists of classes, each contained in its own file on
the file system. However, this is not a requirement. For example, a program might be implemented using namespaced
functions residing in one or more files. A namespace is always required.

Conceptually speaking, a program is translated using the following steps:

1.  Transformation, which converts a program from a particular character
    repertoire and encoding scheme into a sequence of 8-bit characters.

2.  Lexical analysis, which translates a stream of input characters into
    a stream of tokens.

3.  Syntactic analysis, which translates the stream of tokens into
    executable code.


Conforming implementations must accept scripts encoded with the UTF-8 encoding form (as defined by the
[Unicode standard](https://unicode.org/standard/standard.html)), and transform them into a sequence of characters.
Implementations can choose to accept and transform additional character encoding schemes.

## Grammars

This specification shows the syntax of the Zephir programming language using two grammars. The *lexical grammar* defines
how source characters are combined to form white space, comments, and tokens. The *syntactic grammar* defines how the
resulting tokens are combined to form Zephir programs.

The grammars are presented using *grammar productions*, with each one defining a non-terminal symbol and the possible
expansions of that non-terminal symbol into sequences of non-terminal or terminal symbols. In productions, non-terminal
symbols are shown in slanted type *like this*, and terminal symbols are shown in a fixed-width font `like this`.

The first line of a grammar production is the name of the non-terminal symbol being defined, followed by one colon for
a syntactic grammar production, and two colons for a lexical grammar production. Each successive indented line contains
a possible expansion of the non-terminal given as a sequence of non-terminal or terminal symbols. For example, the
production:

<!-- GRAMMAR
single-line-comment-example::
  '//' input-characters?
  '#' input-characters?
-->

defines the lexical grammar production *single-line-comment-example* as being the terminals `//` or `#`, followed by an
optional *input-characters*. Each expansion is listed on a separate line. Please note: the *single-line-comment-example*
grammar production does not exist and provided just for example to show you the main idea. 

Although alternatives are usually listed on separate lines, when there is a large number, the shorthand phrase “one of”
may precede a list of expansions given on a single line. For example:

<!-- GRAMMAR
hexadecimal-digit-example:: one of
  '0' '1' '2' '3' '4' '5' '6' '7' '8' '9'
  'a' 'b' 'c' 'd' 'e' 'f'
  'A' 'B' 'C' 'D' 'E' 'F'
-->

## Lexical analysis

### General

The production *input-file* is the root of the lexical structure for a
program. Each *input-file* must conform to this production.

**Syntax**

<!-- GRAMMAR
input-file::
  input-element
  input-file input-element

input-element::
  comment
  white-space
  token
-->


**Semantics**

The basic elements of a program are comments, white space, and tokens.

The lexical processing of a program involves the reduction of that program into a sequence of [tokens](#tokens)
that becomes the input to the syntactic analysis. Tokens can be separated by [white space](#white-space) and
delimited [comments](#comments).

Lexical processing always results in the creation of the longest possible lexical element. (For example, `a+++++b`
must be parsed as `a++ ++ +b`, which syntactically is invalid).

### Comments

Two forms of comments are supported: *delimited comments* and *single-line comments*.

**Syntax**

<!-- GRAMMAR
comment::
  single-line-comment
  delimited-comment
  
single-line-comment::
  '//' input-characters?
  
input-characters::
  input-character
  input-characters input-character
  
input-character::
  "Any source character except" new-line
  
new-line::
  "Carriage-return character (U+000D)"
  "Line-feed character (U+000A)"
  "Carriage-return character (U+000D) followed by line-feed character (U+000A)"
  
delimited-comment::
  '/*' "No characters or any source character sequence except */" '*/'
-->


**Semantics**

Except within a string literal or a comment, the characters `/*` start a delimited comment, which ends with the
characters `*/`. Except within a string literal or a comment, the characters `//` start a single-line comment, which
may ends with a new line. That new line is not part of the comment. If the single-line comment is the last source
element in a input file, the trailing new line can be omitted.

A delimited comment can occur in any place in a script in which [white
space](#white-space) can occur. (For example;
`/*...*/$c/*...*/=/*...*/567/*...*/;/*...*/` is parsed as `$c=567;`, and
`$k = $i+++/*...*/++$j;` is parsed as `$k = $i+++ ++$j;`).

**Implementation Notes**

During tokenizing, an implementation can treat a delimited comment as
though it was white space.

### White Space

### Tokens

#### General

#### Names

#### Keywords

#### Literals

##### Integer Literals

##### Floating-Point Literals

##### String Literals

###### Single-Quoted String Literals

###### Double-Quoted String Literals

###### Heredoc String Literals

###### Nowdoc String Literals

#### Operators and Punctuators
