-- dbo.vistapractica source

CREATE OR REPLACE VIEW dbo.vistapractica
AS SELECT i."InternshipsId" AS "IdPractica",
    i."AddedDate" AS "FechaDiligenciamiento",
    s."Codigo" AS "CodigoEstudiante",
    s."FirstName" AS "NombresEstudiante",
    s."LastName" AS "ApellidosEstudiante",
    s."Email" AS "CorreoEstudiante",
    s."Phone" AS "TelefonoEstudiante",
    i.type AS "TipoPractica",
    (p."Name" || ' '::text) || p."LastName" AS "NombreCompleto_Docente",
    c."Name" AS "NombreEmpresa_Convenio",
    i."Dependency" AS "DependenciaPractica",
    i."Startdate" AS "IniciaPractica",
    i."EndDate" AS "FinalizaPractica",
    i."EntryTime" AS "HoraEntrada_Practica",
    i."ExitTime" AS "HoraSalida_Practica",
    i."WeekHours" AS "HorasSemanales_Practica",
    i."IsPaid" AS "Remuneracion_Practica",
    (s2."FirstName" || ' '::text) || s2."LastName" AS "NombreCompleto_Responsable",
    s2."Position" AS "CargoResponsable",
    s2."CellPhone" AS "TelefonoResponsable",
    s2."Email" AS "CorreoResponsable",
    i."GeneralGoal" AS "ObjetivoGeneral_Practica",
    i."SpecificGoals" AS "ObjetivosEspecificos_Practica",
    array_agg(p3."Description") AS "Descripciones_Productos",
    array_agg(p3."Date") AS "Fechas_Productos",
    array_agg(r."Description") AS "Descripciones_Informes",
    array_agg(r."Date") AS "Fechas_Informes"
   FROM dbo."Internships" i
     JOIN dbo."Agreements" a ON a."Id" = i."AgreementId"
     JOIN dbo."Company" c ON c."CompanyId" = a."CompanyId"
     JOIN dbo."Student" s ON s."DocumentId" = i."StudentId"
     JOIN dbo."Professor" p ON p."ProfessorsId" = i."ProfessorId"
     JOIN dbo."Supervisor" s2 ON s2."SupervisorId" = i."SupervisorId"
     JOIN dbo."Payment" p2 ON p2."InternshipId" = i."InternshipsId"
     JOIN dbo."Products" p3 ON p3."InternshipId" = i."InternshipsId"
     JOIN dbo."Reports" r ON r."InternshipId" = i."InternshipsId"
  GROUP BY i."InternshipsId", a."Id", c."CompanyId", s."DocumentId", p."ProfessorsId", s2."SupervisorId", p2."PaymentId";
  