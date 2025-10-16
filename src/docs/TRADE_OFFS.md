# Trade-Offs

* Customers table
  * Columns are all required (except dates). Mostly all columns should be optional as if they are missing data, they should still be added and checked, but this depends mostly on requirements.
  * `products` column is a `JSON`. It should be a relationship to a `products` table (using a pivot table -> relation of n:n) if the products exists on our database
  or can be fetched from somewhere, but due to simplicity of this exercise, I just kept it simple like this.
  * `error_message` stores the error messages as a string. If a more advanced error needs to be displayed/stored, I would create another table and inserting all the
  needed data there (relating Customer, Scan, and that errors table).
* Scans table
  * 
