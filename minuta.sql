-- dbo.vistaminuta source

CREATE OR REPLACE VIEW dbo.vistaminuta
AS SELECT m."AddedDate" AS "FechaCreacion",
    m."MinutaId" AS "No_CartaCompromiso",
    a."Type" AS "TipoConvenio",
    i."AgreementId" AS "No_Convenio",
    c."Name" AS "NombreEmpresa_Convenio",
    a."Date" AS "FechaFirma_Convenio",
    a."EndDate" AS "FinalizaConvenio",
    a."StartDate" AS "IniciaConvenio",
    date_part('year'::text, a."EndDate") - date_part('year'::text, a."StartDate") AS "DuracionAnos_Convenio",
    date_part('month'::text, a."EndDate") - date_part('month'::text, a."StartDate") AS "DuracionMesesRestantes_Convenio",
    (date_part('year'::text, a."EndDate") - date_part('year'::text, a."StartDate")) * 12::double precision + (date_part('month'::text, a."EndDate") - date_part('month'::text, a."StartDate")) AS "DuracionMeses_Convenio",
    date_part('day'::text, a."EndDate" - a."StartDate") AS "DuracionDias_Convenio",
    a."Extension" AS "ProrrogaConvenio",
        CASE
            WHEN m."Period" = '1'::text THEN 'primer'::text
            ELSE 'segundo'::text
        END AS "PeriodoPractica",
    date_part('year'::text, i."Startdate")::text AS "AnoPractica",
    s."Faculty" AS "FacultadEstudiante",
    s."Program" AS "ProgramaEstudiante",
    (s."FirstName" || ' '::text) || s."LastName" AS "NombreCompleto_Estudiante",
    s."Cedula" AS "CedulaEstudiante",
    i."SpecificGoals" AS "ObjetivosEspecificos_Practica",
    (p."Name" || ' '::text) || p."LastName" AS "NombreCompleto_Docente",
    (s2."FirstName" || ' '::text) || s2."LastName" AS "NombreCompleto_Responsable",
    i."Startdate" AS "IniciaPractica",
    i."EndDate" AS "FinalizaPractica",
    p2."Total" AS "TotalRemuneracion",
    m."CDP" AS "No_CDP",
    array_agg(f."Amount") AS "Valores_Pagos",
    array_agg(f.date) AS "Fechas_Pagos",
    m."Observations" AS "Anotaciones",
    i."Modality" AS "ModalidadPractica",
    m."BudgetCommitment" AS "CompromisoPresupuestal"
   FROM dbo."Minuta" m
     JOIN dbo."Internships" i ON i."InternshipsId" = m."IntershipId"
     JOIN dbo."Agreements" a ON a."Id" = i."AgreementId"
     JOIN dbo."Company" c ON c."CompanyId" = a."CompanyId"
     JOIN dbo."Student" s ON s."DocumentId" = i."StudentId"
     JOIN dbo."Professor" p ON p."ProfessorsId" = i."ProfessorId"
     JOIN dbo."Supervisor" s2 ON s2."SupervisorId" = i."SupervisorId"
     JOIN dbo."Payment" p2 ON p2."InternshipId" = m."IntershipId"
     JOIN dbo."Fees" f ON f."PaymentId" = p2."PaymentId"
  GROUP BY m."MinutaId", a."Id", i."InternshipsId", c."CompanyId", s."DocumentId", p."ProfessorsId", s2."SupervisorId", p2."PaymentId";
  