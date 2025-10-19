# What did you implement?

# Why did you implement or skip certain things?

* I decided to index `fraudulent`, `external_customer_id`, `bsn`, `iban`, and `tag` as they can be used for searching.
* Also decided to include some data from the API like `lastInvoiceDate` and `lastLoginDateTime` as they can be used to check for fraudulent actions in the future.
* The `scans` table also has a `status` column to keep track of each scans' status. It allows me to insert data when I want (relating the scan) instead of holding
them into memory. So I can insert data by customer or in chunks, but I do not need to hold it into memory until the process is done.
* I am making use of InertiaJS and Vue (and ZiggyJS) to consume and display data more easily, and have better UX.
* I am not validating the API (each customers' data) due to time and simplicity. If the API could return empty values (where they should not), I would validate it
* To allow for a quick replacement of validator (fraudulent checker), I just used interfaces so it can be quickly swaped if needed).

# If you had more time, what would you improve or add?
