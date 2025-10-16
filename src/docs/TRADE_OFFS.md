# Trade-Offs

* Customers table's columns are all required (except dates). Some columns should be optional like `external_customer_id` or `tag`, but they depend mostly on requirements.
* Customers' `products` column is a `JSON`. It should be a relationship to a `products` table (using a pivot table -> relation of n:n) if the products exists on our database
or can be fetched from somewhere, but do to simplicity of this exercise, I just kept it simple like this.
* 
