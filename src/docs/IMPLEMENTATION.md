# What did you implement?

# Why did you implement or skip certain things?

* I decided to index `fraudulent`, `external_customer_id`, `bsn`, `iban`, and `tag` as they can be used for searching.
* Also decided to include some data from the API like `lastInvoiceDate` and `lastLoginDateTime` as they can be used to check for fraudulent actions in the future.
* I am making use of InertiaJS and Vue (and ZiggyJS) to consume and display data more easily, and have better UX.
