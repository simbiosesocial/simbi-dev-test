'use client';

import { useState, type FunctionComponent } from "react";
import type { LoanItemProps } from "./LoanItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip, Alert, Snackbar } from "@mui/material";
import { finalizeLoan, renewLoan } from "@/requests/loans/updateLoan";
import SnackAlert from "@/common/components/SnackAlert/SnackAlert.component";

const formatDateToLocal = (dateString: string): string => {
  const date = new Date(dateString);
  const utcDate = new Date(date.getTime() + date.getTimezoneOffset() * 60000);
  return utcDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
};

export const LoanItem: FunctionComponent<LoanItemProps> = ({ id, status, returnDate, returnedAt, book }) => {
  const [isLoadingRenew, setIsLoadingRenew] = useState(false);
  const [isLoadingFinalize, setIsLoadingFinalize] = useState(false);
  const [alertSuccess, setAlertSuccess] = useState({ open: false, message: '' });
  const [alertError, setAlertError] = useState({ open: false, message: '' });

  const [loan, setLoan] = useState({
    status,
    returnDate,
    returnedAt,
  });
  const finished = loan.status === 'finished';

  const formattedReturnDate = formatDateToLocal(loan.returnDate);
  const formattedReturnedAt = loan.returnedAt && formatDateToLocal(loan.returnedAt);


  const handleRenewLoan = async () => {
    setIsLoadingRenew(true);
    try {
      const data = await renewLoan(id);
      setIsLoadingRenew(false);
      if (data) {
        setAlertSuccess({ open: true, message: "Empréstimo renovado com sucesso!" });
        setLoan({
          ...loan,
          status: data.status,
          returnDate: data.returnDate
        });
      }
    } catch (error) {
      setAlertError({ open: true, message: "Erro ao renovar empréstimo. Tente novamente." });
      console.error("Error renewing loan:", error);
    } finally {
      setIsLoadingRenew(false);
    }
  }

  const handleFinalizeLoan = async () => {
    setIsLoadingFinalize(true);
    try {
      const data = await finalizeLoan(id);
      setIsLoadingFinalize(false);
      if (data) {
        setAlertSuccess({ open: true, message: "Empréstimo finalizado com sucesso!" });
        setLoan({
          ...loan,
          status: data.status,
          returnedAt: data.returnedAt
        });
      }
    } catch (error) {
      setAlertError({ open: true, message: "Erro ao finalizar empréstimo. Tente novamente." });
      console.error("Error finalizing loan:", error);
    } finally {
      setIsLoadingFinalize(false);
    }
  }

  const handleDisabled = () => {
    if (finished) {
      return true;
    } else {
      if (isLoadingRenew || isLoadingFinalize) {
        return true;
      }
    }
    return false;
  }

  return (
    <>
    <Card variant="outlined">
      <CardMedia sx={{ height: 264 }} image={book.coverUrl ? book.coverUrl : "/cover.png"} title={book.title} />
      <CardContent>
        <Tooltip title={book.title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {book.title}
          </Typography>
        </Tooltip>
        
        <Typography variant="overline">
          Status: {loan.status}
        </Typography>

        {finished ? 
          (<Typography>
            Devolvido: {formattedReturnedAt}
          </Typography>)
        :
          (<Typography>
            Data de devolução: {formattedReturnDate}
          </Typography>)
          }
      </CardContent>
      <CardActions>
        <Button 
          size="small" 
          variant="contained" 
          fullWidth 
          onClick={handleRenewLoan}
          disabled={handleDisabled()}
        >
          {isLoadingRenew ? "Processando..." : "Renovar"}
        </Button>
        <Button 
          size="small" 
          variant="contained" 
          fullWidth 
          onClick={handleFinalizeLoan}
          disabled={handleDisabled()}
        >
          {isLoadingFinalize ? "Processando..." : "Devolver"}
        </Button>
      </CardActions>
    </Card>

    <SnackAlert severity="success" state={alertSuccess} setState={setAlertSuccess} />
    <SnackAlert severity="error" state={alertError} setState={setAlertError} />
  </>
  );
};
