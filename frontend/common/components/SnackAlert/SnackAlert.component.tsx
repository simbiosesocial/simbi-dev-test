import { Alert, Snackbar } from "@mui/material";
import { SnackAlertParams } from "./SnackAlert.interface";

const SnackAlert = ({ 
  state, 
  setState, 
  severity,
  children,
  key=severity,
  vertical='bottom', 
  horizontal='right', 
  variant="filled",
  autoHideDuration=3500,
}: SnackAlertParams) => {
  const { open, message } = state;

  const handleClose = () => {
    setState((prev) => ({
        ... prev, 
        open: false
      })
    );
  }
  
  return (
    <Snackbar 
      open={open} 
      autoHideDuration={autoHideDuration} 
      onClose={handleClose}
      anchorOrigin={{ vertical, horizontal }}
      key={key}
    >
      <Alert
        onClose={handleClose}
        severity={severity}
        variant={variant}
        sx={{ width: '100%' }}
      >
        {message}
        {children}
      </Alert>
    </Snackbar>
  );
}

export default SnackAlert;
