// bookLoanList.mock.ts
import type { BookLoanProps } from "./BookLoanList.interface";

export const bookLoansList: BookLoanProps = {
  loans: [
    {
      id: "1",
      user_email: "user1@example.com",
      book_id: "101",
      author_id: "201",
      loan_date: "2024-09-01",
      return_date: "2024-09-15",
    },
    {
      id: "2",
      user_email: "user2@example.com",
      book_id: "102",
      author_id: "202",
      loan_date: "2024-09-05",
      return_date: "2024-09-20",
    },
    {
      id: "3",
      user_email: "user3@example.com",
      book_id: "103",
      author_id: "203",
      loan_date: "2024-09-10",
      return_date: "2024-09-25",
    },
  ],
};
