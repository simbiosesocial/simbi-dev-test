import { render, screen } from "@/common/utils/test-utils";
import { LoansList } from "./LoansList.component";
import { loansList } from "./LoansList.mock";

const loans = loansList.loans;

describe("<LoansList />", () => {
  it("renders LoansList component", () => {
    render(<LoansList {...loansList} />);

    expect(screen.getAllByText(loans[0].book.title)).toBeTruthy();
    expect(screen.getAllByText(loans[1].book.title)).toBeTruthy();
  });
});
