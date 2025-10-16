# What did you implement?

# Why did you implement or skip certain things?

* I decided to index `external_customer_id`, `bsn`, `iban`, and `tag` as they can be used for searching.
* Also added `last_fraudulent_check_at` in case the check is done later in time, and it needs to be retried or rechecked.
