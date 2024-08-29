import { render, screen } from "@/common/utils/test-utils";
import { LoansList } from "./LoansList.component";
import { loansList } from "./LoansList.mock";

const loans = loansList.loans;

describe("<LoansList />", () => {
  it("renders LoansList component", () => {
    render(<LoansList {...loansList} />);

    expect(screen.getByText(loans[0].book.title)).toBeInTheDocument();
    expect(screen.getByText(loans[1].book.title)).toBeInTheDocument();
  });
});
