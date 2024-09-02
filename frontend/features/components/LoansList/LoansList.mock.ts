import { booksList } from "../BooksList/BooksList.mock";
import type { LoansListProps } from "./LoansList.interface";

export const loansList: LoansListProps = {
  loans: [
    {
      "id": "1f489c31-a08b-3595-8b98-9ea05f15cfce",
      "book": {
        "id": "144cd88d-ae0c-37c2-a544-34d14fc114a9",
        "title": "Optio corrupti at facere cumque blanditiis dolor.",
        "publisher": "Fay-Ebert",
        "author": {
          "id": "ba490614-0dc9-3953-af78-4dba91b32d59",
          "name": "Adela Lebsack"
        },
        "isAvailable": true,
      },
      "loanDate": "2024-08-13T00:00:00+00:00",
      "returnDate": "2024-08-20T00:00:00+00:00",
      "status": "finished",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": "2024-08-17T00:00:00+00:00",
      "createdAt": "2024-08-26T09:04:52+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "e52aaac8-8f6f-377c-b4cc-2bd1580f08d3",
      "book": {
        "id": "e8726787-0c1c-3d87-9f61-2aee30fe423f",
        "title": "Ullam quos ea corporis ratione ipsam repellat omnis.",
        "publisher": "Torphy Group",
        "author": {
          "id": "ba490614-0dc9-3953-af78-4dba91b32d59",
          "name": "Adela Lebsack"
        },
        "isAvailable": false,
      },
      "loanDate": "2024-08-13T00:00:00+00:00",
      "returnDate": "2024-08-20T00:00:00+00:00",
      "status": "overdue",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": null,
      "createdAt": "2024-08-26T09:04:52+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "beed2e11-bacc-3b65-9b0b-e80e711bfab8",
      "book": {
        "id": "f4fcba05-5625-3e36-9988-b99a78e87844",
        "title": "Explicabo eos maiores aut minima qui sint sed explicabo.",
        "publisher": "Schinner, Stoltenberg and Heidenreich",
        "author": {
          "id": "1a16f999-ff5f-39d6-a074-bacfab1c7605",
          "name": "Brenda Lynch"
        },
        "isAvailable": false,
      },
      "loanDate": "2024-07-31T00:00:00+00:00",
      "returnDate": "2024-08-07T00:00:00+00:00",
      "status": "overdue",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": null,
      "createdAt": "2024-08-26T09:04:52+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "7894ee2a-809a-4d22-bf59-964229b49e47",
      "book": {
        "id": "144cd88d-ae0c-37c2-a544-34d14fc114a9",
        "title": "Optio corrupti at facere cumque blanditiis dolor.",
        "publisher": "Fay-Ebert",
        "author": {
          "id": "ba490614-0dc9-3953-af78-4dba91b32d59",
          "name": "Adela Lebsack"
        },
        "isAvailable": false,
      },
      "loanDate": "2024-08-26T00:00:00+00:00",
      "returnDate": "2024-09-02T00:00:00+00:00",
      "status": "active",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": null,
      "createdAt": "2024-08-26T10:00:59+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "c1860c91-f2fc-49a6-b0ce-acf5f50ac472",
      "book": {
        "id": "2eded48b-715f-33c6-b268-34397b45c358",
        "title": "Nobis asperiores qui aperiam itaque et a.",
        "publisher": "Stehr-Lockman",
        "author": {
          "id": "872bff1e-f538-32b3-aeef-a0bae53669c9",
          "name": "Travis Kohler"
        },
        "isAvailable": false,
      },
      "loanDate": "2024-08-26T00:00:00+00:00",
      "returnDate": "2024-09-02T00:00:00+00:00",
      "status": "active",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": null,
      "createdAt": "2024-08-26T10:02:44+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "fd40e2f0-8e8a-4201-b625-41e7d5466433",
      "book": {
        "id": "144cd88d-ae0c-37c2-a544-34d14fc114a9",
        "title": "Optio corrupti at facere cumque blanditiis dolor.",
        "publisher": "Fay-Ebert",
        "author": {
          "id": "ba490614-0dc9-3953-af78-4dba91b32d59",
          "name": "Adela Lebsack"
        },
        "isAvailable": false,
      },
      "loanDate": "2024-08-26T00:00:00+00:00",
      "returnDate": "2024-09-02T00:00:00+00:00",
      "status": "active",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": null,
      "createdAt": "2024-08-26T10:29:11+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "9eec01b8-5c25-4263-b682-3fe18e490aa4",
      "book": {
        "id": "144cd88d-ae0c-37c2-a544-34d14fc114a9",
        "title": "Optio corrupti at facere cumque blanditiis dolor.",
        "publisher": "Fay-Ebert",
        "author": {
          "id": "ba490614-0dc9-3953-af78-4dba91b32d59",
          "name": "Adela Lebsack"
        },
        "isAvailable": false,
      },
      "loanDate": "2024-08-26T00:00:00+00:00",
      "returnDate": "2024-09-02T00:00:00+00:00",
      "status": "active",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": null,
      "createdAt": "2024-08-26T10:31:22+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "bd122d67-40e6-4c74-ae95-ec6bdcb690f2",
      "book": {
        "id": "f4fcba05-5625-3e36-9988-b99a78e87844",
        "title": "Explicabo eos maiores aut minima qui sint sed explicabo.",
        "publisher": "Schinner, Stoltenberg and Heidenreich",
        "author": {
          "id": "1a16f999-ff5f-39d6-a074-bacfab1c7605",
          "name": "Brenda Lynch"
        },
        "isAvailable": false,
      },
      "loanDate": "2024-08-26T00:00:00+00:00",
      "returnDate": "2024-09-02T00:00:00+00:00",
      "status": "active",
      "renewalCount": 0,
      "lastRenewedAt": null,
      "returnedAt": null,
      "createdAt": "2024-08-26T10:37:04+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    },
    {
      "id": "0b631bfd-b6ec-30e9-ab38-6db312bab53b",
      "book": {
        "id": "e8726787-0c1c-3d87-9f61-2aee30fe423f",
        "title": "Ullam quos ea corporis ratione ipsam repellat omnis.",
        "publisher": "Torphy Group",
        "author": {
          "id": "ba490614-0dc9-3953-af78-4dba91b32d59",
          "name": "Adela Lebsack"
        },
        "isAvailable": true,
      },
      "loanDate": "2024-08-22T00:00:00+00:00",
      "returnDate": "2024-09-02T00:00:00+00:00",
      "status": "finished",
      "renewalCount": 2,
      "lastRenewedAt": "2024-08-26T00:00:00+00:00",
      "returnedAt": "2024-08-26T00:00:00+00:00",
      "createdAt": "2024-08-26T09:04:52+00:00",
      "updatedAt": "2024-08-26T21:32:39+00:00"
    }
  ],
};
