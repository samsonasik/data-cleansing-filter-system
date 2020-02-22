Continues Integration
=====================

It uses `Github Actions` for Continues Integration, tested under PHP 7.2, 7.3, and 7.4 with MySQL environment.

The configuration can be found at [`.github/workflow/ci_build.yml`](https://github.com/samsonasik/data-cleansing-filter-system/blob/master/.github/workflows/ci_build.yml).

For coverage report, it uses CodeCov that reported at https://codecov.io/gh/samsonasik/data-cleansing-filter-system . The CodeCov Secret saved at repository settings named `CODECOV_TOKEN`:

![Setting CodeCov Token](/docs/image/codecov-setting.png)

so configuration at [`.github/workflow/ci_build.yml`](https://github.com/samsonasik/data-cleansing-filter-system/blob/master/.github/workflows/ci_build.yml) can be used as:

```yml
      - name: Upload coverage to Codecov
        uses: codecov/codecov-action@v1
        with:
          token: ${{ secrets.CODECOV_TOKEN }}
          file: ./coverage.xml
          flags: tests
          name: codecov-umbrella
          yml: ./codecov.yml
          fail_ci_if_error: true
```

[>>> Prev (Testing)](/docs/testing.md)

