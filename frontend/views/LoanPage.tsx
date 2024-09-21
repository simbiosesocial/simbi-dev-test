import { BookLoanForm } from "@/features/components"

interface Props{
  books: Book[];
}

export default function LoanPage({ books = [] }: Props) {
  return (
    <BookLoanForm books={books} />
  )
}