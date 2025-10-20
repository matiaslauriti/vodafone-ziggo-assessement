# Setup

1. You need to have the latest Docker (with Docker Compose) running locally
2. Run `docker compose up -d` to start all the containers
3. Go inside the `src` folder and copy-paste the `.env.example` as `.env` (minimum config is already set for you)
4. The following commands must be run inside the `app` container, so run `docker compose exec app bash`:
   1. Run `composer install`
   2. Run `php artisan key:generate`
   3. Run `php artisan migrate`
   4. Run `npm install`
   5. Run `npm run build`
   6. Run `php artisan queue:work` and leave it running
5. You are ready to go, head to `http://localhost`

# What did you implement?

I created a simple app that allows a user to click a button to start a "scan". It will consume an external API that will give back customers (or fail)
and the app will create a `scan`, store each `customer` related to that scan, and analyze for fraudulent data.

There is a simple tailwindCSS styled UI with a button to start the scan, and a paginated list of scans (2 per page) will be displayed per page, else a simple legend showing there are no scans available to display will show up.

When the scan begins, the button disables to prevent multiple clicks on that page, and once the process gave a result, the page will display the new result (or throw an error (alert) if the customer API failed).

The app makes use of InertiaJS (Vue Composition API), TailwindCSS, Redis, Queues/Jobs and Events/Listeners.

# Why did you implement or skip certain things?

* I decided to index `fraudulent`, `external_customer_id`, `bsn`, `iban`, and `tag` as they can be used for searching.
* Also decided to include some data from the API like `lastInvoiceDate` and `lastLoginDateTime` as they can be used to check for fraudulent actions in the future.
* The `scans` table also has a `status` column to keep track of each scans' status. It allows me to insert data (relating the scan) when I want instead of holding
  that into memory. So I can insert data by customer or in chunks, but I do not need to hold it into memory until the process is done.
* I am making use of InertiaJS and Vue (and ZiggyJS) to consume and display data more easily, and have better UX.
* I am not validating the API (each customers' data) due to time and simplicity. If the API could return empty values, I would validate it.
* To allow for a quick replacement of validator (fraudulent checker), I just used interfaces so it can be quickly swaped if needed.
* I did not make use of multiple queues for simplicity, so the job and the listener will execute on the same queue with the same worker
* The UI/UX can be improved, but as I do not want to waste time on it, I took the simplest and quickest yet presentable UX approach for this exercise. Having more
and better requirements, I would have implemented something better (for example, we as a team, already know what libraries to use for UI and are used to them).
* I did not test all the app, as it would take me a bit more time, but I did simply test the external API to show you a few skills of testing I have (I have done it following TDD).
Feel free to check my [StackOverflow user](https://stackoverflow.com/users/1998801/matiaslauriti) as I am active there and have nice and long responses about testing Laravel apps to give you more insights about my testing skills.

# What trade-offs did you make?

* Customers table
    * Columns are all required (except dates). Mostly all columns should be optional as if they are missing data, they should still be added and checked, but this depends mostly on requirements.
    * `products` column is a `JSON`. It should be a relationship to a `products` table (using a pivot table -> relation of n:n) if the products exists on our database
      or can be fetched from somewhere, but due to simplicity of this exercise, I just kept it simple like this.
    * `error_message` stores the error messages as a string. If a more advanced error needs to be displayed/stored, I would create another table and inserting all the
      needed data there (relating Customer, Scan, and that errors table), or apply a know string format but would be a bit more complex.
* I did not use Pest as the optional task mentioned, as I never used Pest (I checked their documentation in the past).
  To be able to do some testing now (that I feel comfortable with to present to you), I will use PHPUnit as I always did.
* As the API fetcher does not make any validation and returns an array, the trade-off is related to consuming the data.
I always create a DTO and return that instead of a plain array, but I kept it super simple.

# If you had more time, what would you improve or add?

* For the import and validation check, I would have switched the validator check (fraudulent check) of duplicated IP or IBAN to a better query, or any other type
of check, for example, loading values into a Redis cache or other system and doing queries to that system for faster performance.
* The UI/UX can be massively improved, I have just done the minimum needed to meet requirements, and added a tiny design of my own trying to use some VodafoneZiggo color palette.
* The handling of the scan can be improved: re-scan/re-check customers of an existing scan, delete Scans after X time or manual button, add a choice for the type of "fraudulent checker" the user would like to use, and possibly a CSV type of importing could also be achieved if required.
* Of course, add all the missing tests reaching at least 90% of real coverage, especially missing tests for the import and validation part (covering all the cases).
* The results of the scans and the customers could be exported if needed.
* Maybe an action can be done or executed on a customer from a scan, that would help other teams if needed.
