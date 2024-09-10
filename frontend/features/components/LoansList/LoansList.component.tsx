import type { FunctionComponent } from "react";
import type { LoansListProps } from "./LoansList.interface";
import Grid from "@mui/material/Unstable_Grid2";
import { LoanItem } from "../LoanItem";
import { Loan } from "@/declarations";

export const LoansList: FunctionComponent<LoansListProps> = ({ loans }) => {
  const compareLoanItems = (a: Loan, b: Loan) => {
    if (a.status === 'finished' && b.status !== 'finished') {
      return 1;
    }
    if (a.status !== 'finished' && b.status === 'finished') {
      return -1;
    }
    return new Date(a.loanDate).getTime() - new Date(b.loanDate).getTime();
  };

const sortedLoanItems = loans.sort(compareLoanItems);
  return (
    <Grid container spacing={2}>
      {sortedLoanItems.map((loan) => (
        <Grid xs={12} sm={6} md={4} key={loan.id}>
          <LoanItem {...loan} />
        </Grid>
      ))}
    </Grid>
  );
};
