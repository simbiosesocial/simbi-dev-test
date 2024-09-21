"use client";
import type { FunctionComponent } from "react";
import { BookLoanProps } from './BookLoanList.interface';
import { Card, CardContent, Typography, Grid } from "@mui/material";

export const BookLoanList: FunctionComponent<BookLoanProps> = ({ loans }) => {
  return (
    <div>
      <Typography variant="h4" gutterBottom>
        Lista de Empréstimos
      </Typography>
      <Grid container spacing={3}>
        {loans.map((loan) => (
          <Grid item xs={12} sm={6} md={4} key={loan.id}>
            <Card>
              <CardContent>
                <Typography variant="h6" component="div">
                  Email: {loan.user_email}
                </Typography>
                <Typography color="textSecondary">
                  Livro ID: {loan.book_id}
                </Typography>
                <Typography color="textSecondary">
                  Autor ID: {loan.author_id}
                </Typography>
                <Typography color="textSecondary">
                  Data de Empréstimo: {loan.loan_date}
                </Typography>
                <Typography color="textSecondary">
                  Data de Devolução: {loan.return_date}
                </Typography>
              </CardContent>
            </Card>
          </Grid>
        ))}
      </Grid>
    </div>
  );
};
