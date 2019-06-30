PHP CC Spot A Home
==================

- This code challenge has been implemented and designed following DDD and Hexagonal architecture practices
- Is virtualized with Docker using docker-compose
- Main source code is in PL (Platform) and Shared contexts in `/app/src`, rest of the folder are framework (Symfony) configuration related
- Folder in `src/PL/Homes` it's a module for Homes in the Platform context

Build and start the php
-----------------------

```sh
$ make build
```
Once all docker services are up and running, open your browser and go to `https://localhost/index.html`

Run functional test
-----------------------

```sh
$ make test
```

### TODO LIST

- [ ] Add unit tests (you can find examples in my repo, i.e: https://github.com/ajordi/cc-wirvonhier/tree/master/src/tests)
- [ ] Improve functional test with verifying the response
- [ ] Separate frontend code in different app in a proper way not just everything in one file ()
